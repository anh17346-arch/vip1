@extends('layouts.app')

@section('title', 'Chi tiết khuyến mãi - Perfume Luxury')

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
          <h1 class="text-3xl font-bold text-slate-900 dark:text-slate-100">Chi tiết khuyến mãi</h1>
          <p class="text-slate-600 dark:text-slate-400 mt-2">Thông tin chi tiết về khuyến mãi</p>
        </div>
        <div class="flex items-center space-x-3">
          <a href="{{ route('admin.promotions.edit', $promotion) }}" 
             class="inline-flex items-center px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white font-medium rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Chỉnh sửa
          </a>
          <a href="{{ route('admin.promotions.index') }}" 
             class="inline-flex items-center px-4 py-2 bg-slate-600 hover:bg-slate-700 text-white font-medium rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Quay lại
          </a>
        </div>
      </div>
    </div>

    <!-- Promotion Details -->
    <div class="backdrop-blur-md bg-white/20 dark:bg-white/5 rounded-2xl shadow-lg border border-white/30 dark:border-white/10 overflow-hidden">
      <!-- Header Card -->
      <div class="p-6 border-b border-slate-200/60 dark:border-slate-700">
        <div class="flex items-center justify-between">
          <div>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-slate-100">{{ $promotion->name }}</h2>
            @if($promotion->name_en)
              <p class="text-slate-600 dark:text-slate-400 mt-1">{{ $promotion->name_en }}</p>
            @endif
          </div>
          <div class="text-right">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                       {{ $promotion->is_valid ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400' : 
                          (!$promotion->is_active ? 'bg-gray-100 text-gray-800 dark:bg-gray-900/20 dark:text-gray-400' : 
                           ($promotion->start_date > now() ? 'bg-amber-100 text-amber-800 dark:bg-amber-900/20 dark:text-amber-400' : 
                            'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400')) }}">
              {{ $promotion->status_text }}
            </span>
          </div>
        </div>
      </div>

      <div class="p-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
          <!-- Basic Information -->
          <div class="space-y-6">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100 border-b border-slate-200/60 dark:border-slate-700 pb-2">
              Thông tin cơ bản
            </h3>

            <!-- Code -->
            <div>
              <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Mã khuyến mãi</label>
              <div class="flex items-center space-x-2">
                <span class="inline-flex items-center px-3 py-1 rounded-lg bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-400 font-mono text-sm">
                  {{ $promotion->code }}
                </span>
                <button onclick="navigator.clipboard.writeText('{{ $promotion->code }}')" 
                        class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                  </svg>
                </button>
              </div>
            </div>

            <!-- Description -->
            @if($promotion->description)
              <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Mô tả</label>
                <p class="text-slate-900 dark:text-slate-100">{{ $promotion->description }}</p>
              </div>
            @endif

            @if($promotion->description_en)
              <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Mô tả (Tiếng Anh)</label>
                <p class="text-slate-900 dark:text-slate-100">{{ $promotion->description_en }}</p>
              </div>
            @endif

            <!-- Created By -->
            <div>
              <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Tạo bởi</label>
              <p class="text-slate-900 dark:text-slate-100">{{ $promotion->creator->name }}</p>
            </div>

            <!-- Created Date -->
            <div>
              <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Ngày tạo</label>
              <p class="text-slate-900 dark:text-slate-100">{{ $promotion->created_at->format('d/m/Y H:i') }}</p>
            </div>
          </div>

          <!-- Discount Information -->
          <div class="space-y-6">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100 border-b border-slate-200/60 dark:border-slate-700 pb-2">
              Thông tin giảm giá
            </h3>

            <!-- Discount Type & Value -->
            <div>
              <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Loại giảm giá</label>
              <div class="flex items-center space-x-2">
                <span class="text-lg font-bold text-emerald-600 dark:text-emerald-400">{{ $promotion->discount_text }}</span>
                <span class="text-sm text-slate-500 dark:text-slate-400">
                  ({{ $promotion->discount_type == 'percentage' ? 'Phần trăm' : 'Số tiền cố định' }})
                </span>
              </div>
            </div>

            <!-- Min Order Amount -->
            @if($promotion->min_order_amount > 0)
              <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Giá trị đơn hàng tối thiểu</label>
                <p class="text-slate-900 dark:text-slate-100">{{ number_format($promotion->min_order_amount) }} VNĐ</p>
              </div>
            @endif

            <!-- Max Discount Amount -->
            @if($promotion->max_discount_amount)
              <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Giảm giá tối đa</label>
                <p class="text-slate-900 dark:text-slate-100">{{ number_format($promotion->max_discount_amount) }} VNĐ</p>
              </div>
            @endif

            <!-- Usage -->
            <div>
              <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Sử dụng</label>
              <p class="text-slate-900 dark:text-slate-100">
                {{ $promotion->used_count }}/{{ $promotion->usage_limit ?: '∞' }}
                @if($promotion->usage_limit)
                  <span class="text-sm text-slate-500 dark:text-slate-400">
                    ({{ $promotion->remaining_usage }} lượt còn lại)
                  </span>
                @endif
              </p>
            </div>

            <!-- User Type -->
            <div>
              <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Áp dụng cho người dùng</label>
              <p class="text-slate-900 dark:text-slate-100">
                @switch($promotion->user_type)
                  @case('all_users')
                    Tất cả người dùng
                    @break
                  @case('new_users')
                    Người dùng mới (≤ 30 ngày)
                    @break
                  @case('existing_users')
                    Người dùng cũ (> 30 ngày)
                    @break
                @endswitch
              </p>
            </div>
          </div>
        </div>

        <!-- Date Range -->
        <div class="mt-8 space-y-6">
          <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100 border-b border-slate-200/60 dark:border-slate-700 pb-2">
            Thời gian áp dụng
          </h3>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Ngày bắt đầu</label>
              <p class="text-slate-900 dark:text-slate-100">{{ $promotion->start_date->format('d/m/Y H:i') }}</p>
            </div>
            <div>
              <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Ngày kết thúc</label>
              <p class="text-slate-900 dark:text-slate-100">{{ $promotion->end_date->format('d/m/Y H:i') }}</p>
            </div>
          </div>
        </div>

        <!-- Target Products -->
        <div class="mt-8 space-y-6">
          <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100 border-b border-slate-200/60 dark:border-slate-700 pb-2">
            Sản phẩm áp dụng
          </h3>

          <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Phạm vi áp dụng</label>
            <p class="text-slate-900 dark:text-slate-100 mb-4">
              @switch($promotion->applies_to)
                @case('all_products')
                  Tất cả sản phẩm
                  @break
                @case('specific_categories')
                  Danh mục cụ thể
                  @break
                @case('specific_products')
                  Sản phẩm cụ thể
                  @break
              @endswitch
            </p>

            @if($promotion->applies_to == 'specific_categories' && $promotion->categories->count() > 0)
              <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Danh mục được chọn</label>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                  @foreach($promotion->categories as $category)
                    <span class="inline-flex items-center px-2 py-1 rounded-md text-sm bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-400">
                      {{ $category->name }}
                    </span>
                  @endforeach
                </div>
              </div>
            @endif

            @if($promotion->applies_to == 'specific_products' && $promotion->products->count() > 0)
              <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Sản phẩm được chọn</label>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                  @foreach($promotion->products as $product)
                    <span class="inline-flex items-center px-2 py-1 rounded-md text-sm bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400">
                      {{ $product->name }}
                    </span>
                  @endforeach
                </div>
              </div>
            @endif
          </div>
        </div>

        <!-- Actions -->
        <div class="mt-8 pt-6 border-t border-slate-200/60 dark:border-slate-700">
          <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
              <form action="{{ route('admin.promotions.toggle-status', $promotion) }}" method="POST" class="inline">
                @csrf
                <button type="submit" 
                        class="px-4 py-2 {{ $promotion->is_active ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} text-white font-medium rounded-lg transition-colors duration-200">
                  {{ $promotion->is_active ? 'Vô hiệu hóa' : 'Kích hoạt' }}
                </button>
              </form>
            </div>
            <form action="{{ route('admin.promotions.destroy', $promotion) }}" method="POST" class="inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa khuyến mãi này?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors duration-200">
                Xóa khuyến mãi
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

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