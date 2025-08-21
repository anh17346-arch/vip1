<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'status',
        'payment_method',
        'payment_status',
        'shipping_name',
        'shipping_phone',
        'shipping_address',
        'shipping_city',
        'shipping_district',
        'notes',
        'subtotal',
        'shipping_fee',
        'total',
    ];

    protected $casts = [
        'subtotal' => 'decimal:0',
        'shipping_fee' => 'decimal:0',
        'total' => 'decimal:0',
    ];

    /**
     * Get the user that owns the order
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the order items
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get formatted total price
     */
    public function getFormattedTotalAttribute()
    {
        return number_format($this->total, 0, ',', '.') . 'đ';
    }

    /**
     * Get formatted subtotal price
     */
    public function getFormattedSubtotalAttribute()
    {
        return number_format($this->subtotal, 0, ',', '.') . 'đ';
    }

    /**
     * Get formatted shipping fee
     */
    public function getFormattedShippingFeeAttribute()
    {
        return number_format($this->shipping_fee, 0, ',', '.') . 'đ';
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'processing' => 'bg-blue-100 text-blue-800',
            'shipped' => 'bg-purple-100 text-purple-800',
            'delivered' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    /**
     * Get payment status badge class
     */
    public function getPaymentStatusBadgeClassAttribute()
    {
        return match($this->payment_status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'processing' => 'bg-blue-100 text-blue-800',
            'paid' => 'bg-green-100 text-green-800',
            'failed' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    /**
     * Get status display name
     */
    public function getStatusDisplayAttribute()
    {
        return match($this->status) {
            'pending' => 'Chờ xử lý',
            'processing' => 'Đang xử lý',
            'shipped' => 'Đã gửi hàng',
            'delivered' => 'Đã giao hàng',
            'cancelled' => 'Đã hủy',
            default => 'Không xác định',
        };
    }

    /**
     * Get payment status display name
     */
    public function getPaymentStatusDisplayAttribute()
    {
        return match($this->payment_status) {
            'pending' => 'Chờ thanh toán',
            'processing' => 'Đang xử lý',
            'paid' => 'Đã thanh toán',
            'failed' => 'Thanh toán thất bại',
            default => 'Không xác định',
        };
    }

    /**
     * Get payment method display name
     */
    public function getPaymentMethodDisplayAttribute()
    {
        return match($this->payment_method) {
            'momo' => 'Ví MoMo',
            'zalopay' => 'ZaloPay',
            'bank_transfer' => 'Chuyển khoản ngân hàng',
            'cod' => 'Thanh toán khi nhận hàng',
            default => 'Không xác định',
        };
    }
}