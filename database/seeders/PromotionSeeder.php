<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promotion;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin user
        $adminUser = User::where('role', 'admin')->first();
        if (!$adminUser) {
            $adminUser = User::first();
        }

        // Get some categories and products for specific promotions
        $categories = Category::take(3)->get();
        $products = Product::take(5)->get();

        $promotions = [
            [
                'name' => 'Khuyến mãi mùa hè',
                'name_en' => 'Summer Sale',
                'description' => 'Giảm giá lớn cho tất cả sản phẩm nước hoa trong mùa hè',
                'description_en' => 'Big discount for all perfume products in summer',
                'discount_type' => 'percentage',
                'discount_value' => 15,
                'min_order_amount' => 500000,
                'max_discount_amount' => 1000000,
                'usage_limit' => 100,
                'used_count' => 25,
                'start_date' => Carbon::now()->subDays(10),
                'end_date' => Carbon::now()->addDays(20),
                'is_active' => true,
                'code' => 'SUMMER2024',
                'applies_to' => 'all_products',
                'user_type' => 'all_users',
                'created_by' => $adminUser->id,
            ],
            [
                'name' => 'Khuyến mãi cho khách hàng mới',
                'name_en' => 'New Customer Discount',
                'description' => 'Ưu đãi đặc biệt dành cho khách hàng mới đăng ký',
                'description_en' => 'Special offer for new registered customers',
                'discount_type' => 'fixed_amount',
                'discount_value' => 200000,
                'min_order_amount' => 1000000,
                'max_discount_amount' => 200000,
                'usage_limit' => 50,
                'used_count' => 12,
                'start_date' => Carbon::now()->subDays(5),
                'end_date' => Carbon::now()->addDays(30),
                'is_active' => true,
                'code' => 'NEWCUSTOMER',
                'applies_to' => 'all_products',
                'user_type' => 'new_users',
                'created_by' => $adminUser->id,
            ],
            [
                'name' => 'Khuyến mãi nước hoa nam',
                'name_en' => 'Men Perfume Sale',
                'description' => 'Giảm giá cho các sản phẩm nước hoa nam',
                'description_en' => 'Discount for men perfume products',
                'discount_type' => 'percentage',
                'discount_value' => 20,
                'min_order_amount' => 300000,
                'max_discount_amount' => 500000,
                'usage_limit' => 75,
                'used_count' => 8,
                'start_date' => Carbon::now()->subDays(15),
                'end_date' => Carbon::now()->addDays(15),
                'is_active' => true,
                'code' => 'MENPERFUME',
                'applies_to' => 'specific_categories',
                'category_ids' => $categories->pluck('id')->toArray(),
                'user_type' => 'all_users',
                'created_by' => $adminUser->id,
            ],
            [
                'name' => 'Khuyến mãi sản phẩm cao cấp',
                'name_en' => 'Premium Products Sale',
                'description' => 'Giảm giá cho các sản phẩm cao cấp được chọn lọc',
                'description_en' => 'Discount for selected premium products',
                'discount_type' => 'percentage',
                'discount_value' => 25,
                'min_order_amount' => 2000000,
                'max_discount_amount' => 1000000,
                'usage_limit' => 30,
                'used_count' => 5,
                'start_date' => Carbon::now()->subDays(20),
                'end_date' => Carbon::now()->addDays(10),
                'is_active' => true,
                'code' => 'PREMIUM25',
                'applies_to' => 'specific_products',
                'product_ids' => $products->pluck('id')->toArray(),
                'user_type' => 'existing_users',
                'created_by' => $adminUser->id,
            ],
            [
                'name' => 'Khuyến mãi Black Friday',
                'name_en' => 'Black Friday Sale',
                'description' => 'Siêu khuyến mãi Black Friday với giảm giá cực sốc',
                'description_en' => 'Super Black Friday sale with shocking discounts',
                'discount_type' => 'percentage',
                'discount_value' => 30,
                'min_order_amount' => 0,
                'max_discount_amount' => 2000000,
                'usage_limit' => 200,
                'used_count' => 0,
                'start_date' => Carbon::now()->addDays(5),
                'end_date' => Carbon::now()->addDays(8),
                'is_active' => true,
                'code' => 'BLACKFRIDAY',
                'applies_to' => 'all_products',
                'user_type' => 'all_users',
                'created_by' => $adminUser->id,
            ],
            [
                'name' => 'Khuyến mãi đã hết hạn',
                'name_en' => 'Expired Promotion',
                'description' => 'Khuyến mãi này đã hết hạn để test giao diện',
                'description_en' => 'This promotion has expired for testing interface',
                'discount_type' => 'percentage',
                'discount_value' => 10,
                'min_order_amount' => 100000,
                'max_discount_amount' => 100000,
                'usage_limit' => 50,
                'used_count' => 15,
                'start_date' => Carbon::now()->subDays(30),
                'end_date' => Carbon::now()->subDays(5),
                'is_active' => true,
                'code' => 'EXPIRED10',
                'applies_to' => 'all_products',
                'user_type' => 'all_users',
                'created_by' => $adminUser->id,
            ],
            [
                'name' => 'Khuyến mãi bị vô hiệu',
                'name_en' => 'Disabled Promotion',
                'description' => 'Khuyến mãi này đã bị vô hiệu hóa',
                'description_en' => 'This promotion has been disabled',
                'discount_type' => 'fixed_amount',
                'discount_value' => 50000,
                'min_order_amount' => 500000,
                'max_discount_amount' => 50000,
                'usage_limit' => 100,
                'used_count' => 0,
                'start_date' => Carbon::now()->subDays(10),
                'end_date' => Carbon::now()->addDays(20),
                'is_active' => false,
                'code' => 'DISABLED50',
                'applies_to' => 'all_products',
                'user_type' => 'all_users',
                'created_by' => $adminUser->id,
            ],
        ];

        foreach ($promotions as $promotionData) {
            $promotion = Promotion::create($promotionData);

            // Sync relationships if needed
            if ($promotion->applies_to === 'specific_categories' && isset($promotionData['category_ids'])) {
                $promotion->categories()->sync($promotionData['category_ids']);
            }

            if ($promotion->applies_to === 'specific_products' && isset($promotionData['product_ids'])) {
                $promotion->products()->sync($promotionData['product_ids']);
            }
        }

        $this->command->info('Promotions seeded successfully!');
    }
}