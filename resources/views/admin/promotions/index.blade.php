@extends('layouts.app')

@section('title', 'Quản lý khuyến mãi - Perfume Luxury')

@section('content')
<div class="min-h-screen relative overflow-hidden">
  <!-- Animated Background -->
  <div class="fixed inset-0 -z-10">
    <div class="absolute inset-0 bg-gradient-to-br from-slate-50 via-blue-50/60 via-purple-50/60 to-pink-50/60 dark:from-slate-900 dark:via-blue-900/30 dark:via-purple-900/30 dark:to-pink-900/30"></div>
    <div class="absolute top-20 left-10 w-64 h-64 bg-gradient-to-r from-blue-400/10 to-purple-400/10 dark:from-blue-400/5 dark:to-purple-400/5 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl animate-blob"></div>
    <div class="absolute top-40 right-20 w-72 h-72 bg-gradient-to-r from-pink-400/10 to-rose-400/10 dark:from-pink-400/5 dark:to-rose-400/5 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl animate-blob animation-delay-2000"></div>
  </div>

  <div class="relative max-w-7xl mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
      <div class="flex items-center justify-between">
        <div>
          <h1 class="text-3xl font-bold text-slate-900 dark:text-slate-100">Quản lý khuyến mãi</h1>
          <p class="text-slate-600 dark:text-slate-400 mt-2">Quản lý các chương trình khuyến mãi cho sản phẩm</p>
        </div>
        <a href="{{ route('admin.promotions.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-500 to-green-500 hover:from-emerald-600 hover:to-green-600 text-white font-medium rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
          </svg>
          Tạo khuyến mãi mới
        </a>
      </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
      <div class="backdrop-blur-md bg-white/20 dark:bg-white/5 rounded-2xl p-6 shadow-lg border border-white/30 dark:border-white/10">
        <div class="flex items-center">
          <div class="p-3 rounded-xl bg-blue-100 dark:bg-blue-900/20">
            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
            </svg>
          </div>
          <div class="ml-4">
            <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Tổng khuyến mãi</p>
            <p class="text-2xl font-bold text-slate-900 dark:text-slate-100">{{ $promotions->total() }}</p>
          </div>
        </div>
      </div>

      <div class="backdrop-blur-md bg-white/20 dark:bg-white/5 rounded-2xl p-6 shadow-lg border border-white/30 dark:border-white/10">
        <div class="flex items-center">
          <div class="p-3 rounded-xl bg-green-100 dark:bg-green-900/20">
            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <div class="ml-4">
            <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Đang hoạt động</p>
            <p class="text-2xl font-bold text-slate-900 dark:text-slate-100">{{ $promotions->where('is_active', true)->count() }}</p>
          </div>
        </div>
      </div>

      <div class="backdrop-blur-md bg-white/20 dark:bg-white/5 rounded-2xl p-6 shadow-lg border border-white/30 dark:border-white/10">
        <div class="flex items-center">
          <div class="p-3 rounded-xl bg-amber-100 dark:bg-amber-900/20">
            <svg class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <div class="ml-4">
            <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Sắp diễn ra</p>
            <p class="text-2xl font-bold text-slate-900 dark:text-slate-100">{{ $promotions->where('start_date', '>', now())->count() }}</p>
          </div>
        </div>
      </div>

      <div class="backdrop-blur-md bg-white/20 dark:bg-white/5 rounded-2xl p-6 shadow-lg border border-white/30 dark:border-white/10">
        <div class="flex items-center">
          <div class="p-3 rounded-xl bg-red-100 dark:bg-red-900/20">
            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </div>
          <div class="ml-4">
            <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Đã hết hạn</p>
            <p class="text-2xl font-bold text-slate-900 dark:text-slate-100">{{ $promotions->where('end_date', '<', now())->count() }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Promotions List -->
    <div class="backdrop-blur-md bg-white/20 dark:bg-white/5 rounded-2xl shadow-lg border border-white/30 dark:border-white/10 overflow-hidden">
      <div class="p-6 border-b border-slate-200/60 dark:border-slate-700">
        <h2 class="text-xl font-semibold text-slate-900 dark:text-slate-100">Danh sách khuyến mãi</h2>
      </div>

      @if($promotions->count() > 0)
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead class="bg-slate-50/50 dark:bg-slate-800/50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Khuyến mãi</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Mã</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Giảm giá</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Thời gian</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Trạng thái</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Sử dụng</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Thao tác</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-200/60 dark:divide-slate-700">
              @foreach($promotions as $promotion)
                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors duration-200">
                  <td class="px-6 py-4">
                    <div>
                      <div class="text-sm font-medium text-slate-900 dark:text-slate-100">{{ $promotion->name }}</div>
                      <div class="text-sm text-slate-500 dark:text-slate-400">{{ Str::limit($promotion->description, 50) }}</div>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-400">
                      {{ $promotion->code }}
                    </span>
                  </td>
                  <td class="px-6 py-4">
                    <div class="text-sm font-medium text-slate-900 dark:text-slate-100">{{ $promotion->discount_text }}</div>
                    @if($promotion->min_order_amount > 0)
                      <div class="text-xs text-slate-500 dark:text-slate-400">Từ {{ number_format($promotion->min_order_amount) }}đ</div>
                    @endif
                  </td>
                  <td class="px-6 py-4">
                    <div class="text-sm text-slate-900 dark:text-slate-100">
                      {{ $promotion->start_date->format('d/m/Y') }} - {{ $promotion->end_date->format('d/m/Y') }}
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    @if($promotion->is_valid)
                      <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400">
                        Hoạt động
                      </span>
                    @elseif(!$promotion->is_active)
                      <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-900/20 dark:text-gray-400">
                        Vô hiệu
                      </span>
                    @elseif($promotion->start_date > now())
                      <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900/20 dark:text-amber-400">
                        Sắp diễn ra
                      </span>
                    @else
                      <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400">
                        Hết hạn
                      </span>
                    @endif
                  </td>
                  <td class="px-6 py-4">
                    <div class="text-sm text-slate-900 dark:text-slate-100">
                      {{ $promotion->used_count }}/{{ $promotion->usage_limit ?: '∞' }}
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex items-center space-x-2">
                      <a href="{{ route('admin.promotions.show', $promotion) }}" 
                         class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                      </a>
                      <a href="{{ route('admin.promotions.edit', $promotion) }}" 
                         class="text-amber-600 hover:text-amber-900 dark:text-amber-400 dark:hover:text-amber-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                      </a>
                      <form action="{{ route('admin.promotions.toggle-status', $promotion) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                          </svg>
                        </button>
                      </form>
                      <form action="{{ route('admin.promotions.destroy', $promotion) }}" method="POST" class="inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa khuyến mãi này?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                          </svg>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-slate-200/60 dark:border-slate-700">
          {{ $promotions->links() }}
        </div>
      @else
        <div class="p-12 text-center">
          <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
          </svg>
          <h3 class="mt-2 text-sm font-medium text-slate-900 dark:text-slate-100">Chưa có khuyến mãi nào</h3>
          <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Bắt đầu tạo khuyến mãi đầu tiên của bạn.</p>
          <div class="mt-6">
            <a href="{{ route('admin.promotions.create') }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
              <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
              </svg>
              Tạo khuyến mãi mới
            </a>
          </div>
        </div>
      @endif
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