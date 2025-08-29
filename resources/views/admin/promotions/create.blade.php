@extends('layouts.app')

@section('title', 'Tạo khuyến mãi mới - Perfume Luxury')

@section('content')
<div class="min-h-screen relative overflow-hidden">
  <!-- Animated Background -->
  <div class="fixed inset-0 -z-10">
    <div class="absolute inset-0 bg-gradient-to-br from-slate-50 via-blue-50/60 via-purple-50/60 to-pink-50/60 dark:from-slate-900 dark:via-blue-900/30 dark:via-purple-900/30 dark:to-pink-900/30"></div>
    <div class="absolute top-20 left-10 w-64 h-64 bg-gradient-to-r from-blue-400/10 to-purple-400/10 dark:from-blue-400/5 dark:to-purple-400/5 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl animate-blob"></div>
    <div class="absolute top-40 right-20 w-72 h-72 bg-gradient-to-r from-pink-400/10 to-rose-400/10 dark:from-pink-400/5 dark:to-rose-400/5 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl animate-blob animation-delay-2000"></div>
  </div>

  <div class="relative max-w-4xl mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
      <div class="flex items-center justify-between">
        <div>
          <h1 class="text-3xl font-bold text-slate-900 dark:text-slate-100">Tạo khuyến mãi mới</h1>
          <p class="text-slate-600 dark:text-slate-400 mt-2">Thêm chương trình khuyến mãi mới vào hệ thống</p>
        </div>
        <a href="{{ route('admin.promotions.index') }}" 
           class="inline-flex items-center px-4 py-2 bg-slate-600 hover:bg-slate-700 text-white font-medium rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
          </svg>
          Quay lại
        </a>
      </div>
    </div>

    <!-- Form -->
    <div class="backdrop-blur-md bg-white/20 dark:bg-white/5 rounded-2xl shadow-lg border border-white/30 dark:border-white/10 overflow-hidden">
      <form action="{{ route('admin.promotions.store') }}" method="POST" class="p-6">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
          <!-- Basic Information -->
          <div class="space-y-6">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100 border-b border-slate-200/60 dark:border-slate-700 pb-2">
              Thông tin cơ bản
            </h3>

            <!-- Name -->
            <div>
              <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                Tên khuyến mãi <span class="text-red-500">*</span>
              </label>
              <input type="text" name="name" id="name" value="{{ old('name') }}" required
                     class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:bg-slate-800 dark:text-slate-100">
              @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <!-- Name English -->
            <div>
              <label for="name_en" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                Tên khuyến mãi (Tiếng Anh)
              </label>
              <input type="text" name="name_en" id="name_en" value="{{ old('name_en') }}"
                     class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:bg-slate-800 dark:text-slate-100">
              @error('name_en')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <!-- Description -->
            <div>
              <label for="description" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                Mô tả
              </label>
              <textarea name="description" id="description" rows="3"
                        class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:bg-slate-800 dark:text-slate-100">{{ old('description') }}</textarea>
              @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <!-- Description English -->
            <div>
              <label for="description_en" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                Mô tả (Tiếng Anh)
              </label>
              <textarea name="description_en" id="description_en" rows="3"
                        class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:bg-slate-800 dark:text-slate-100">{{ old('description_en') }}</textarea>
              @error('description_en')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <!-- Code -->
            <div>
              <label for="code" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                Mã khuyến mãi <span class="text-red-500">*</span>
              </label>
              <div class="flex">
                <input type="text" name="code" id="code" value="{{ old('code') }}" required
                       class="flex-1 px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-l-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:bg-slate-800 dark:text-slate-100">
                <button type="button" id="generate-code" 
                        class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-r-lg transition-colors duration-200">
                  Tạo mã
                </button>
              </div>
              @error('code')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <!-- Discount Settings -->
          <div class="space-y-6">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100 border-b border-slate-200/60 dark:border-slate-700 pb-2">
              Cài đặt giảm giá
            </h3>

            <!-- Discount Type -->
            <div>
              <label for="discount_type" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                Loại giảm giá <span class="text-red-500">*</span>
              </label>
              <select name="discount_type" id="discount_type" required
                      class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:bg-slate-800 dark:text-slate-100">
                <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Phần trăm (%)</option>
                <option value="fixed_amount" {{ old('discount_type') == 'fixed_amount' ? 'selected' : '' }}>Số tiền cố định (VNĐ)</option>
              </select>
              @error('discount_type')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <!-- Discount Value -->
            <div>
              <label for="discount_value" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                Giá trị giảm giá <span class="text-red-500">*</span>
              </label>
              <input type="number" name="discount_value" id="discount_value" value="{{ old('discount_value') }}" 
                     step="0.01" min="0" required
                     class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:bg-slate-800 dark:text-slate-100">
              @error('discount_value')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <!-- Min Order Amount -->
            <div>
              <label for="min_order_amount" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                Giá trị đơn hàng tối thiểu (VNĐ)
              </label>
              <input type="number" name="min_order_amount" id="min_order_amount" value="{{ old('min_order_amount', 0) }}" 
                     step="1000" min="0"
                     class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:bg-slate-800 dark:text-slate-100">
              @error('min_order_amount')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <!-- Max Discount Amount -->
            <div>
              <label for="max_discount_amount" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                Giảm giá tối đa (VNĐ)
              </label>
              <input type="number" name="max_discount_amount" id="max_discount_amount" value="{{ old('max_discount_amount') }}" 
                     step="1000" min="0"
                     class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:bg-slate-800 dark:text-slate-100">
              @error('max_discount_amount')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <!-- Usage Limit -->
            <div>
              <label for="usage_limit" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                Giới hạn sử dụng
              </label>
              <input type="number" name="usage_limit" id="usage_limit" value="{{ old('usage_limit') }}" 
                     min="1" placeholder="Để trống = không giới hạn"
                     class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:bg-slate-800 dark:text-slate-100">
              @error('usage_limit')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
          </div>
        </div>

        <!-- Date Range -->
        <div class="mt-8 space-y-6">
          <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100 border-b border-slate-200/60 dark:border-slate-700 pb-2">
            Thời gian áp dụng
          </h3>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Start Date -->
            <div>
              <label for="start_date" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                Ngày bắt đầu <span class="text-red-500">*</span>
              </label>
              <input type="datetime-local" name="start_date" id="start_date" value="{{ old('start_date') }}" required
                     class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:bg-slate-800 dark:text-slate-100">
              @error('start_date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <!-- End Date -->
            <div>
              <label for="end_date" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                Ngày kết thúc <span class="text-red-500">*</span>
              </label>
              <input type="datetime-local" name="end_date" id="end_date" value="{{ old('end_date') }}" required
                     class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:bg-slate-800 dark:text-slate-100">
              @error('end_date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
          </div>
        </div>

        <!-- Target Settings -->
        <div class="mt-8 space-y-6">
          <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100 border-b border-slate-200/60 dark:border-slate-700 pb-2">
            Đối tượng áp dụng
          </h3>

          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Applies To -->
            <div>
              <label for="applies_to" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                Áp dụng cho <span class="text-red-500">*</span>
              </label>
              <select name="applies_to" id="applies_to" required
                      class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:bg-slate-800 dark:text-slate-100">
                <option value="all_products" {{ old('applies_to') == 'all_products' ? 'selected' : '' }}>Tất cả sản phẩm</option>
                <option value="specific_categories" {{ old('applies_to') == 'specific_categories' ? 'selected' : '' }}>Danh mục cụ thể</option>
                <option value="specific_products" {{ old('applies_to') == 'specific_products' ? 'selected' : '' }}>Sản phẩm cụ thể</option>
              </select>
              @error('applies_to')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <!-- User Type -->
            <div>
              <label for="user_type" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                Loại người dùng <span class="text-red-500">*</span>
              </label>
              <select name="user_type" id="user_type" required
                      class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:bg-slate-800 dark:text-slate-100">
                <option value="all_users" {{ old('user_type') == 'all_users' ? 'selected' : '' }}>Tất cả người dùng</option>
                <option value="new_users" {{ old('user_type') == 'new_users' ? 'selected' : '' }}>Người dùng mới (≤ 30 ngày)</option>
                <option value="existing_users" {{ old('user_type') == 'existing_users' ? 'selected' : '' }}>Người dùng cũ (> 30 ngày)</option>
              </select>
              @error('user_type')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <!-- Categories Selection -->
          <div id="categories-section" class="hidden">
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
              Chọn danh mục
            </label>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 max-h-48 overflow-y-auto p-3 border border-slate-300 dark:border-slate-600 rounded-lg">
              @foreach($categories as $category)
                <label class="flex items-center space-x-2 cursor-pointer">
                  <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" 
                         {{ in_array($category->id, old('category_ids', [])) ? 'checked' : '' }}
                         class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                  <span class="text-sm text-slate-700 dark:text-slate-300">{{ $category->name }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <!-- Products Selection -->
          <div id="products-section" class="hidden">
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
              Chọn sản phẩm
            </label>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 max-h-48 overflow-y-auto p-3 border border-slate-300 dark:border-slate-600 rounded-lg">
              @foreach($products as $product)
                <label class="flex items-center space-x-2 cursor-pointer">
                  <input type="checkbox" name="product_ids[]" value="{{ $product->id }}" 
                         {{ in_array($product->id, old('product_ids', [])) ? 'checked' : '' }}
                         class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                  <span class="text-sm text-slate-700 dark:text-slate-300">{{ $product->name }}</span>
                </label>
              @endforeach
            </div>
          </div>
        </div>

        <!-- Status -->
        <div class="mt-8">
          <label class="flex items-center space-x-2 cursor-pointer">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}
                   class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Kích hoạt khuyến mãi ngay</span>
          </label>
        </div>

        <!-- Submit Buttons -->
        <div class="mt-8 flex items-center justify-end space-x-4">
          <a href="{{ route('admin.promotions.index') }}" 
             class="px-6 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-medium rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors duration-200">
            Hủy
          </a>
          <button type="submit" 
                  class="px-6 py-2 bg-gradient-to-r from-emerald-500 to-green-500 hover:from-emerald-600 hover:to-green-600 text-white font-medium rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
            Tạo khuyến mãi
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const appliesTo = document.getElementById('applies_to');
    const categoriesSection = document.getElementById('categories-section');
    const productsSection = document.getElementById('products-section');
    const generateCodeBtn = document.getElementById('generate-code');
    const codeInput = document.getElementById('code');

    // Toggle sections based on applies_to selection
    function toggleSections() {
        const value = appliesTo.value;
        categoriesSection.classList.toggle('hidden', value !== 'specific_categories');
        productsSection.classList.toggle('hidden', value !== 'specific_products');
    }

    appliesTo.addEventListener('change', toggleSections);
    toggleSections(); // Initial state

    // Generate promotion code
    generateCodeBtn.addEventListener('click', function() {
        fetch('{{ route("admin.promotions.generate-code") }}')
            .then(response => response.json())
            .then(data => {
                codeInput.value = data.code;
            })
            .catch(error => {
                console.error('Error generating code:', error);
            });
    });

    // Set default dates
    const now = new Date();
    const startDate = document.getElementById('start_date');
    const endDate = document.getElementById('end_date');
    
    if (!startDate.value) {
        startDate.value = new Date(now.getTime() + 24 * 60 * 60 * 1000).toISOString().slice(0, 16);
    }
    
    if (!endDate.value) {
        endDate.value = new Date(now.getTime() + 7 * 24 * 60 * 60 * 1000).toISOString().slice(0, 16);
    }
});
</script>

<style>
@keyframes blob {
  0% { transform: translate(0px, 0px) scale(1); }
  33% { transform: translate(30px, -50px) scale(1.1); }
  66% { transform: translate(-20px, 20px) scale(0.9); }
  100% { transform: translate(0px, 0px) scale(1); }
}
.animate-blob {
  animation: blob 7s infinite;
}
.animation-delay-2000 {
  animation-delay: 2s;
}
</style>
@endsection