@extends('layouts.app')

@section('title', 'Đơn hàng của tôi - Perfume Luxury')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-slate-50 to-slate-100 dark:from-slate-900 dark:to-slate-950">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-4 mb-4">
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 text-slate-600 dark:text-slate-400 hover:text-brand-600 dark:hover:text-brand-400 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Quay lại tài khoản
                </a>
            </div>
            <h1 class="text-3xl font-bold text-slate-900 dark:text-slate-100 mb-2">Đơn hàng của tôi</h1>
            <p class="text-slate-600 dark:text-slate-400">Quản lý và theo dõi tất cả đơn hàng của bạn</p>
        </div>

        <!-- Filters and Search -->
        <div class="backdrop-blur-sm bg-white/40 dark:bg-white/10 rounded-2xl p-6 border border-white/50 dark:border-white/20 shadow-lg mb-8">
            <form method="GET" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Tìm kiếm</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Mã đơn hàng..."
                               class="w-full px-4 py-2 bg-white/60 dark:bg-slate-800/60 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all">
                    </div>
                    
                    <!-- Status Filter -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Trạng thái</label>
                        <select name="status" class="w-full px-4 py-2 bg-white/60 dark:bg-slate-800/60 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all">
                            <option value="">Tất cả</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                            <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Đã gửi hàng</option>
                            <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Đã giao hàng</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                        </select>
                    </div>
                    
                    <!-- Payment Status Filter -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Thanh toán</label>
                        <select name="payment_status" class="w-full px-4 py-2 bg-white/60 dark:bg-slate-800/60 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all">
                            <option value="">Tất cả</option>
                            <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Chờ thanh toán</option>
                            <option value="processing" {{ request('payment_status') == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                            <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Đã thanh toán</option>
                            <option value="failed" {{ request('payment_status') == 'failed' ? 'selected' : '' }}>Thất bại</option>
                        </select>
                    </div>
                    
                    <!-- Filter Button -->
                    <div class="flex items-end">
                        <button type="submit" class="w-full px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white rounded-lg font-medium transition-all duration-300">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                            Lọc
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Status Tabs -->
        <div class="flex flex-wrap gap-2 mb-6">
            <a href="{{ route('orders.index') }}" 
               class="px-4 py-2 {{ !request('status') ? 'bg-brand-600 text-white' : 'bg-white/60 dark:bg-slate-800/60 text-slate-700 dark:text-slate-300 hover:bg-brand-50 dark:hover:bg-brand-900/20' }} rounded-lg font-medium transition-all border border-slate-200 dark:border-slate-600">
                Tất cả ({{ $statusCounts['all'] }})
            </a>
            <a href="{{ route('orders.index', ['status' => 'pending']) }}" 
               class="px-4 py-2 {{ request('status') == 'pending' ? 'bg-yellow-600 text-white' : 'bg-white/60 dark:bg-slate-800/60 text-slate-700 dark:text-slate-300 hover:bg-yellow-50 dark:hover:bg-yellow-900/20' }} rounded-lg font-medium transition-all border border-slate-200 dark:border-slate-600">
                Chờ xử lý ({{ $statusCounts['pending'] }})
            </a>
            <a href="{{ route('orders.index', ['status' => 'processing']) }}" 
               class="px-4 py-2 {{ request('status') == 'processing' ? 'bg-blue-600 text-white' : 'bg-white/60 dark:bg-slate-800/60 text-slate-700 dark:text-slate-300 hover:bg-blue-50 dark:hover:bg-blue-900/20' }} rounded-lg font-medium transition-all border border-slate-200 dark:border-slate-600">
                Đang xử lý ({{ $statusCounts['processing'] }})
            </a>
            <a href="{{ route('orders.index', ['status' => 'shipped']) }}" 
               class="px-4 py-2 {{ request('status') == 'shipped' ? 'bg-purple-600 text-white' : 'bg-white/60 dark:bg-slate-800/60 text-slate-700 dark:text-slate-300 hover:bg-purple-50 dark:hover:bg-purple-900/20' }} rounded-lg font-medium transition-all border border-slate-200 dark:border-slate-600">
                Đã gửi hàng ({{ $statusCounts['shipped'] }})
            </a>
            <a href="{{ route('orders.index', ['status' => 'delivered']) }}" 
               class="px-4 py-2 {{ request('status') == 'delivered' ? 'bg-green-600 text-white' : 'bg-white/60 dark:bg-slate-800/60 text-slate-700 dark:text-slate-300 hover:bg-green-50 dark:hover:bg-green-900/20' }} rounded-lg font-medium transition-all border border-slate-200 dark:border-slate-600">
                Đã giao hàng ({{ $statusCounts['delivered'] }})
            </a>
        </div>

        <!-- Orders List -->
        @if($orders->count() > 0)
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="backdrop-blur-sm bg-white/40 dark:bg-white/10 rounded-2xl p-6 border border-white/50 dark:border-white/20 shadow-lg hover:shadow-xl transition-all duration-300">
                        <!-- Order Header -->
                        <div class="flex flex-wrap items-center justify-between gap-4 mb-4">
                            <div class="flex items-center gap-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">
                                        Đơn hàng #{{ $order->order_number }}
                                    </h3>
                                    <p class="text-sm text-slate-600 dark:text-slate-400">
                                        {{ $order->created_at->format('d/m/Y H:i') }}
                                    </p>
                                </div>
                                
                                <!-- Status Badges -->
                                <div class="flex gap-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $order->status_badge_class }}">
                                        {{ $order->status_display }}
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $order->payment_status_badge_class }}">
                                        {{ $order->payment_status_display }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="text-right">
                                <p class="text-lg font-bold text-slate-900 dark:text-slate-100">{{ $order->formatted_total }}</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">{{ $order->payment_method_display }}</p>
                            </div>
                        </div>

                        <!-- Order Items Preview -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                            @foreach($order->items->take(3) as $item)
                                <div class="flex items-center gap-3 p-3 bg-slate-50/80 dark:bg-slate-800/50 rounded-lg border border-slate-200 dark:border-slate-700">
                                    <img src="{{ $item->product->main_image_url }}" alt="{{ $item->product->name }}" 
                                         class="w-12 h-12 object-cover rounded-lg">
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-medium text-slate-900 dark:text-slate-100 truncate text-sm">{{ $item->product->name }}</h4>
                                        <p class="text-xs text-slate-600 dark:text-slate-400">{{ $item->formatted_price }} × {{ $item->quantity }}</p>
                                    </div>
                                </div>
                            @endforeach
                            
                            @if($order->items->count() > 3)
                                <div class="flex items-center justify-center p-3 bg-slate-50/80 dark:bg-slate-800/50 rounded-lg border border-slate-200 dark:border-slate-700">
                                    <span class="text-sm text-slate-600 dark:text-slate-400">
                                        +{{ $order->items->count() - 3 }} sản phẩm khác
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Order Actions -->
                        <div class="flex flex-wrap gap-3 pt-4 border-t border-slate-200 dark:border-slate-700">
                            <!-- View Details -->
                            <a href="{{ route('orders.show', $order) }}" 
                               class="inline-flex items-center gap-2 px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white rounded-lg font-medium transition-all duration-300 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Xem chi tiết
                            </a>

                            <!-- Cancel Order (if pending) -->
                            @if($order->status === 'pending')
                                <form method="POST" action="{{ route('orders.cancel', $order) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này?')"
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-all duration-300 text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Hủy đơn
                                    </button>
                                </form>
                            @endif

                            <!-- Reorder -->
                            @if($order->status === 'delivered')
                                <form method="POST" action="{{ route('orders.reorder', $order) }}" class="inline">
                                    @csrf
                                    <button type="submit"
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-medium transition-all duration-300 text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                        Đặt lại
                                    </button>
                                </form>
                            @endif

                            <!-- Download Invoice -->
                            <a href="{{ route('orders.invoice', $order) }}" 
                               class="inline-flex items-center gap-2 px-4 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-lg font-medium transition-all duration-300 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Hóa đơn
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="backdrop-blur-sm bg-white/40 dark:bg-white/10 rounded-2xl p-12 border border-white/50 dark:border-white/20 shadow-lg">
                    <div class="text-slate-400 dark:text-slate-500 mb-6">
                        <svg class="w-24 h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-slate-900 dark:text-slate-100 mb-4">Chưa có đơn hàng nào</h3>
                    <p class="text-slate-600 dark:text-slate-400 mb-8">Bạn chưa có đơn hàng nào. Hãy khám phá các sản phẩm tuyệt vời của chúng tôi!</p>
                    <a href="{{ route('products.index') }}" 
                       class="inline-flex items-center gap-2 px-6 py-3 bg-brand-600 hover:bg-brand-700 text-white rounded-xl font-semibold transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        Bắt đầu mua sắm
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection