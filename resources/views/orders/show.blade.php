@extends('layouts.app')

@section('title', 'Đơn hàng #' . $order->order_number . ' - Perfume Luxury')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-slate-50 to-slate-100 dark:from-slate-900 dark:to-slate-950">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-4 mb-4">
                <a href="{{ route('orders.index') }}" class="flex items-center gap-2 text-slate-600 dark:text-slate-400 hover:text-brand-600 dark:hover:text-brand-400 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Quay lại đơn hàng
                </a>
            </div>
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-slate-900 dark:text-slate-100 mb-2">Đơn hàng #{{ $order->order_number }}</h1>
                    <p class="text-slate-600 dark:text-slate-400">Đặt hàng lúc {{ $order->created_at->format('d/m/Y H:i') }}</p>
                </div>
                
                <!-- Order Status -->
                <div class="flex flex-col items-end gap-2">
                    <div class="flex gap-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $order->status_badge_class }}">
                            {{ $order->status_display }}
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $order->payment_status_badge_class }}">
                            {{ $order->payment_status_display }}
                        </span>
                    </div>
                    <p class="text-lg font-bold text-slate-900 dark:text-slate-100">{{ $order->formatted_total }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Order Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Order Items -->
                <div class="backdrop-blur-sm bg-white/40 dark:bg-white/10 rounded-2xl p-6 border border-white/50 dark:border-white/20 shadow-lg">
                    <h2 class="text-xl font-semibold text-slate-900 dark:text-slate-200 mb-6 flex items-center gap-3">
                        <svg class="w-5 h-5 text-brand-600 dark:text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        Sản phẩm đã đặt ({{ $order->items->count() }})
                    </h2>

                    <div class="space-y-4">
                        @foreach($order->items as $item)
                            <div class="flex items-center gap-4 p-4 bg-slate-50/80 dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700">
                                <img src="{{ $item->product->main_image_url }}" alt="{{ $item->product->name }}" 
                                     class="w-20 h-20 object-cover rounded-lg">
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-medium text-slate-900 dark:text-slate-100 mb-1">{{ $item->product->name }}</h3>
                                    <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">{{ $item->product->brand }} • {{ $item->product->volume_ml }}ml</p>
                                    <div class="flex items-center gap-4">
                                        <span class="text-sm font-medium text-slate-900 dark:text-slate-100">{{ $item->formatted_price }}</span>
                                        <span class="text-sm text-slate-600 dark:text-slate-400">× {{ $item->quantity }}</span>
                                        <span class="text-sm font-semibold text-brand-600">= {{ $item->formatted_total }}</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <a href="{{ route('products.show', $item->product) }}" 
                                       class="inline-flex items-center gap-1 px-3 py-1 text-brand-600 hover:text-brand-700 bg-brand-50 hover:bg-brand-100 dark:bg-brand-900/20 dark:hover:bg-brand-900/30 rounded-lg text-sm font-medium transition-all">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Xem sản phẩm
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Order Summary -->
                    <div class="border-t border-slate-200 dark:border-slate-700 pt-6 mt-6">
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-600 dark:text-slate-400">Tạm tính</span>
                                <span class="font-medium text-slate-900 dark:text-slate-100">{{ $order->formatted_subtotal }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-600 dark:text-slate-400">Phí vận chuyển</span>
                                <span class="font-medium text-slate-900 dark:text-slate-100">{{ $order->formatted_shipping_fee }}</span>
                            </div>
                            <div class="border-t border-slate-200 dark:border-slate-700 pt-3">
                                <div class="flex justify-between">
                                    <span class="text-lg font-semibold text-slate-900 dark:text-slate-100">Tổng cộng</span>
                                    <span class="text-xl font-bold text-brand-600 dark:text-brand-400">{{ $order->formatted_total }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping Information -->
                <div class="backdrop-blur-sm bg-white/40 dark:bg-white/10 rounded-2xl p-6 border border-white/50 dark:border-white/20 shadow-lg">
                    <h2 class="text-xl font-semibold text-slate-900 dark:text-slate-200 mb-6 flex items-center gap-3">
                        <svg class="w-5 h-5 text-brand-600 dark:text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Thông tin giao hàng
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Người nhận</label>
                            <p class="text-slate-900 dark:text-slate-100 font-medium">{{ $order->shipping_name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Số điện thoại</label>
                            <p class="text-slate-900 dark:text-slate-100 font-medium">{{ $order->shipping_phone }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Địa chỉ</label>
                            <p class="text-slate-900 dark:text-slate-100 font-medium">
                                {{ $order->shipping_address }}, {{ $order->shipping_district }}, {{ $order->shipping_city }}
                            </p>
                        </div>
                        @if($order->notes)
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Ghi chú</label>
                                <p class="text-slate-900 dark:text-slate-100 bg-slate-50 dark:bg-slate-800 p-3 rounded-lg">{{ $order->notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Payment Instructions -->
                @if($order->payment_method === 'bank_transfer' && $order->payment_status === 'pending')
                    <div class="backdrop-blur-sm bg-blue-50/80 dark:bg-blue-900/20 rounded-2xl p-6 border border-blue-200 dark:border-blue-800/30 shadow-lg">
                        <h2 class="text-xl font-semibold text-blue-900 dark:text-blue-100 mb-4 flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                            </svg>
                            Thông tin chuyển khoản
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-blue-800 dark:text-blue-200">
                            <div>
                                <p class="text-sm font-medium mb-1">Ngân hàng:</p>
                                <p class="font-semibold">Vietcombank</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium mb-1">Số tài khoản:</p>
                                <p class="font-mono font-semibold">0123456789</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium mb-1">Chủ tài khoản:</p>
                                <p class="font-semibold">PERFUME LUXURY</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium mb-1">Số tiền:</p>
                                <p class="font-semibold text-lg">{{ $order->formatted_total }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-sm font-medium mb-1">Nội dung chuyển khoản:</p>
                                <p class="font-mono font-semibold bg-blue-100 dark:bg-blue-900/30 p-2 rounded">{{ $order->order_number }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Order Status & Actions -->
            <div class="lg:col-span-1">
                <div class="backdrop-blur-sm bg-white/40 dark:bg-white/10 rounded-2xl p-6 border border-white/50 dark:border-white/20 shadow-lg sticky top-8">
                    <h2 class="text-xl font-semibold text-slate-900 dark:text-slate-200 mb-6 flex items-center gap-3">
                        <svg class="w-5 h-5 text-brand-600 dark:text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Thông tin đơn hàng
                    </h2>

                    <div class="space-y-4 mb-6">
                        <!-- Order Status -->
                        <div class="flex items-center justify-between p-3 bg-slate-50/80 dark:bg-slate-800/50 rounded-lg">
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Trạng thái đơn hàng</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $order->status_badge_class }}">
                                {{ $order->status_display }}
                            </span>
                        </div>

                        <!-- Payment Status -->
                        <div class="flex items-center justify-between p-3 bg-slate-50/80 dark:bg-slate-800/50 rounded-lg">
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Trạng thái thanh toán</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $order->payment_status_badge_class }}">
                                {{ $order->payment_status_display }}
                            </span>
                        </div>

                        <!-- Payment Method -->
                        <div class="flex items-center justify-between p-3 bg-slate-50/80 dark:bg-slate-800/50 rounded-lg">
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Phương thức thanh toán</span>
                            <span class="text-sm font-medium text-slate-900 dark:text-slate-100">{{ $order->payment_method_display }}</span>
                        </div>

                        <!-- Order Date -->
                        <div class="flex items-center justify-between p-3 bg-slate-50/80 dark:bg-slate-800/50 rounded-lg">
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Ngày đặt hàng</span>
                            <span class="text-sm font-medium text-slate-900 dark:text-slate-100">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>

                    <!-- Order Actions -->
                    <div class="space-y-3">
                        <!-- Cancel Order (if pending) -->
                        @if($order->status === 'pending')
                            <form method="POST" action="{{ route('orders.cancel', $order) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này?')"
                                        class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl font-medium transition-all duration-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Hủy đơn hàng
                                </button>
                            </form>
                        @endif

                        <!-- Reorder (if delivered) -->
                        @if($order->status === 'delivered')
                            <form method="POST" action="{{ route('orders.reorder', $order) }}">
                                @csrf
                                <button type="submit"
                                        class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-medium transition-all duration-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                    Đặt lại đơn hàng
                                </button>
                            </form>
                        @endif

                        <!-- Download Invoice -->
                        <a href="{{ route('orders.invoice', $order) }}" 
                           class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 rounded-xl font-medium transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Tải hóa đơn
                        </a>

                        <!-- Continue Shopping -->
                        <a href="{{ route('products.index') }}" 
                           class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-brand-600 hover:bg-brand-700 text-white rounded-xl font-medium transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Tiếp tục mua sắm
                        </a>
                    </div>

                    <!-- Order Timeline -->
                    <div class="mt-6 pt-6 border-t border-slate-200 dark:border-slate-700">
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-200 mb-4">Tiến trình đơn hàng</h3>
                        <div class="space-y-3">
                            <!-- Order Placed -->
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <div>
                                    <p class="text-sm font-medium text-slate-900 dark:text-slate-100">Đơn hàng đã được đặt</p>
                                    <p class="text-xs text-slate-600 dark:text-slate-400">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>

                            <!-- Processing -->
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 {{ in_array($order->status, ['processing', 'shipped', 'delivered']) ? 'bg-blue-500' : 'bg-slate-300 dark:bg-slate-600' }} rounded-full"></div>
                                <div>
                                    <p class="text-sm font-medium text-slate-900 dark:text-slate-100">Đang xử lý</p>
                                    @if(in_array($order->status, ['processing', 'shipped', 'delivered']))
                                        <p class="text-xs text-slate-600 dark:text-slate-400">Đã xử lý</p>
                                    @else
                                        <p class="text-xs text-slate-600 dark:text-slate-400">Chờ xử lý</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Shipped -->
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 {{ in_array($order->status, ['shipped', 'delivered']) ? 'bg-purple-500' : 'bg-slate-300 dark:bg-slate-600' }} rounded-full"></div>
                                <div>
                                    <p class="text-sm font-medium text-slate-900 dark:text-slate-100">Đã gửi hàng</p>
                                    @if(in_array($order->status, ['shipped', 'delivered']))
                                        <p class="text-xs text-slate-600 dark:text-slate-400">Đang vận chuyển</p>
                                    @else
                                        <p class="text-xs text-slate-600 dark:text-slate-400">Chưa gửi hàng</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Delivered -->
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 {{ $order->status === 'delivered' ? 'bg-green-500' : 'bg-slate-300 dark:bg-slate-600' }} rounded-full"></div>
                                <div>
                                    <p class="text-sm font-medium text-slate-900 dark:text-slate-100">Đã giao hàng</p>
                                    @if($order->status === 'delivered')
                                        <p class="text-xs text-slate-600 dark:text-slate-400">Giao hàng thành công</p>
                                    @else
                                        <p class="text-xs text-slate-600 dark:text-slate-400">Chưa giao hàng</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection