<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_en',
        'description',
        'description_en',
        'discount_type', // percentage, fixed_amount
        'discount_value',
        'min_order_amount',
        'max_discount_amount',
        'usage_limit',
        'used_count',
        'start_date',
        'end_date',
        'is_active',
        'code',
        'applies_to', // all_products, specific_categories, specific_products
        'category_ids', // JSON array of category IDs
        'product_ids', // JSON array of product IDs
        'user_type', // all_users, new_users, existing_users
        'created_by',
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'min_order_amount' => 'decimal:2',
        'max_discount_amount' => 'decimal:2',
        'usage_limit' => 'integer',
        'used_count' => 'integer',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
        'category_ids' => 'array',
        'product_ids' => 'array',
    ];

    protected $appends = [
        'is_valid',
        'remaining_usage',
        'discount_text',
        'status_text'
    ];

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'promotion_categories');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'promotion_products');
    }

    // Scopes
    public function scopeActive(Builder $query)
    {
        return $query->where('is_active', true);
    }

    public function scopeValid(Builder $query)
    {
        $now = Carbon::now();
        return $query->where('is_active', true)
                    ->where('start_date', '<=', $now)
                    ->where('end_date', '>=', $now)
                    ->where(function ($q) {
                        $q->whereNull('usage_limit')
                          ->orWhereRaw('used_count < usage_limit');
                    });
    }

    public function scopeByCode(Builder $query, $code)
    {
        return $query->where('code', $code);
    }

    // Accessors
    public function getIsValidAttribute()
    {
        $now = Carbon::now();
        return $this->is_active &&
               $this->start_date <= $now &&
               $this->end_date >= $now &&
               ($this->usage_limit === null || $this->used_count < $this->usage_limit);
    }

    public function getRemainingUsageAttribute()
    {
        if ($this->usage_limit === null) {
            return 'Unlimited';
        }
        return max(0, $this->usage_limit - $this->used_count);
    }

    public function getDiscountTextAttribute()
    {
        if ($this->discount_type === 'percentage') {
            return $this->discount_value . '%';
        }
        return number_format($this->discount_value) . ' VNĐ';
    }

    public function getStatusTextAttribute()
    {
        if (!$this->is_active) {
            return 'Inactive';
        }

        $now = Carbon::now();
        if ($this->start_date > $now) {
            return 'Upcoming';
        }
        if ($this->end_date < $now) {
            return 'Expired';
        }
        if ($this->usage_limit && $this->used_count >= $this->usage_limit) {
            return 'Usage Limit Reached';
        }
        return 'Active';
    }

    // Methods
    public function calculateDiscount($orderAmount)
    {
        if ($orderAmount < $this->min_order_amount) {
            return 0;
        }

        $discount = 0;
        if ($this->discount_type === 'percentage') {
            $discount = $orderAmount * ($this->discount_value / 100);
        } else {
            $discount = $this->discount_value;
        }

        if ($this->max_discount_amount) {
            $discount = min($discount, $this->max_discount_amount);
        }

        return $discount;
    }

    public function incrementUsage()
    {
        $this->increment('used_count');
    }

    public function canBeUsedBy($user = null)
    {
        if (!$this->is_valid) {
            return false;
        }

        if ($this->user_type === 'new_users' && $user && $user->created_at->diffInDays(now()) > 30) {
            return false;
        }

        if ($this->user_type === 'existing_users' && $user && $user->created_at->diffInDays(now()) <= 30) {
            return false;
        }

        return true;
    }
}