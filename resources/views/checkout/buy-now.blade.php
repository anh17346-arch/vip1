@extends('layouts.app')

@section('title', __('app.buy_now') . ' - ' . $product->display_name)

@section('content')
<!-- Modern Unified Background (giống cart và orders) -->
<div class="min-h-screen relative overflow-hidden">
  <!-- Animated Background -->
  <div class="fixed inset-0 -z-10">
    <!-- Main Gradient Background -->
    <div class="absolute inset-0 bg-gradient-to-br from-slate-50 via-blue-50/60 via-purple-50/60 to-pink-50/60 dark:from-slate-900 dark:via-blue-900/30 dark:via-purple-900/30 dark:to-pink-900/30"></div>
    
    <!-- Floating Animated Blobs -->
    <div class="absolute top-20 left-10 w-64 h-64 bg-gradient-to-r from-blue-400/10 to-purple-400/10 dark:from-blue-400/5 dark:to-purple-400/5 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl animate-blob"></div>
    <div class="absolute top-40 right-20 w-72 h-72 bg-gradient-to-r from-pink-400/10 to-rose-400/10 dark:from-pink-400/5 dark:to-rose-400/5 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl animate-blob animation-delay-2000"></div>
    <div class="absolute bottom-32 left-1/3 w-80 h-80 bg-gradient-to-r from-cyan-400/10 to-teal-400/10 dark:from-cyan-400/5 dark:to-teal-400/5 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl animate-blob animation-delay-4000"></div>
    <div class="absolute bottom-20 right-1/4 w-56 h-56 bg-gradient-to-r from-emerald-400/10 to-green-400/10 dark:from-emerald-400/5 dark:to-green-400/5 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl animate-blob animation-delay-6000"></div>
    
    <!-- Mesh Gradient Overlay -->
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_50%,rgba(120,119,198,0.1),transparent_50%)] dark:bg-[radial-gradient(circle_at_50%_50%,rgba(120,119,198,0.05),transparent_50%)]"></div>
    
    <!-- Subtle Grid Pattern -->
    <div class="absolute inset-0 bg-[linear-gradient(rgba(100,116,139,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(100,116,139,0.03)_1px,transparent_1px)] bg-[size:64px_64px] dark:bg-[linear-gradient(rgba(148,163,184,0.02)_1px,transparent_1px),linear-gradient(90deg,rgba(148,163,184,0.02)_1px,transparent_1px)]"></div>
  </div>

  <!-- Modern Toast Notifications -->
  @include('partials.toast')

<div class="relative container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-4 mb-4">
                <a href="{{ route('products.show', $product) }}" class="flex items-center gap-2 text-slate-600 dark:text-slate-400 hover:text-brand-600 dark:hover:text-brand-400 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    {{ __('app.back_to_product') }}
                </a>
            </div>
            <h1 class="text-3xl font-bold text-slate-900 dark:text-slate-100 mb-2">{{ __('app.buy_now') }}</h1>
            <p class="text-slate-600 dark:text-slate-400">{{ __('app.complete_order_info') }}</p>
        </div>

        <form method="POST" action="{{ route('checkout.process') }}" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @csrf
            <input type="hidden" name="buy_now_product_id" value="{{ $product->id }}">
            <input type="hidden" name="buy_now_quantity" value="{{ $cartItem->quantity }}">
            
            <!-- Left Column - Checkout Form -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Shipping Information -->
                <div class="backdrop-blur-sm bg-white/40 dark:bg-white/10 rounded-2xl p-6 border border-white/50 dark:border-white/20 shadow-lg">
                    <h2 class="text-xl font-semibold text-slate-900 dark:text-slate-200 mb-6 flex items-center gap-3">
                        <svg class="w-5 h-5 text-brand-600 dark:text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Thông tin giao hàng
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Họ và tên *</label>
                            <input type="text" name="shipping_name" value="{{ auth()->user()->name ?? old('shipping_name') }}" required
                                   class="w-full px-4 py-3 bg-white/60 dark:bg-slate-800/60 border border-slate-300 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Số điện thoại *</label>
                            <input type="tel" name="shipping_phone" value="{{ old('shipping_phone') }}" required
                                   class="w-full px-4 py-3 bg-white/60 dark:bg-slate-800/60 border border-slate-300 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all">
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Địa chỉ *</label>
                            <input type="text" name="shipping_address" value="{{ old('shipping_address') }}" required
                                   class="w-full px-4 py-3 bg-white/60 dark:bg-slate-800/60 border border-slate-300 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Thành phố *</label>
                            <select name="shipping_city" required
                                    class="w-full px-4 py-3 bg-white/60 dark:bg-slate-800/60 border border-slate-300 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all">
                                <option value="">Chọn thành phố</option>
                                <option value="Ho Chi Minh" {{ old('shipping_city') == 'Ho Chi Minh' ? 'selected' : '' }}>Hồ Chí Minh</option>
                                <option value="Ha Noi" {{ old('shipping_city') == 'Ha Noi' ? 'selected' : '' }}>Hà Nội</option>
                                <option value="Da Nang" {{ old('shipping_city') == 'Da Nang' ? 'selected' : '' }}>Đà Nẵng</option>
                                <option value="Can Tho" {{ old('shipping_city') == 'Can Tho' ? 'selected' : '' }}>Cần Thơ</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Quận/Huyện *</label>
                            <input type="text" name="shipping_district" value="{{ old('shipping_district') }}" required
                                   class="w-full px-4 py-3 bg-white/60 dark:bg-slate-800/60 border border-slate-300 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all">
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Ghi chú</label>
                            <textarea name="notes" rows="3" placeholder="Ghi chú cho đơn hàng (tùy chọn)"
                                      class="w-full px-4 py-3 bg-white/60 dark:bg-slate-800/60 border border-slate-300 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all resize-none">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Payment Methods -->
                <div class="backdrop-blur-sm bg-white/40 dark:bg-white/10 rounded-2xl p-6 border border-white/50 dark:border-white/20 shadow-lg">
                    <h2 class="text-xl font-semibold text-slate-900 dark:text-slate-200 mb-6 flex items-center gap-3">
                        <svg class="w-5 h-5 text-brand-600 dark:text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        Phương thức thanh toán
                    </h2>
                    
                    <div class="space-y-4">
                        <!-- MoMo -->
                        <label class="flex items-center p-4 bg-gradient-to-r from-pink-50 to-purple-50 dark:from-pink-900/20 dark:to-purple-900/20 border border-pink-200 dark:border-pink-800/30 rounded-xl cursor-pointer hover:bg-gradient-to-r hover:from-pink-100 hover:to-purple-100 dark:hover:from-pink-800/30 dark:hover:to-purple-800/30 transition-all">
                            <input type="radio" name="payment_method" value="momo" class="w-4 h-4 text-pink-600 border-gray-300 focus:ring-pink-500">
                            <div class="ml-4 flex items-center gap-3">
                                <div class="w-8 h-8 bg-pink-600 rounded-lg flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">M</span>
                                </div>
                                <div>
                                    <div class="font-medium text-slate-900 dark:text-slate-100">Ví MoMo</div>
                                    <div class="text-sm text-slate-600 dark:text-slate-400">Thanh toán nhanh chóng và an toàn</div>
                                </div>
                            </div>
                        </label>

                        <!-- ZaloPay -->
                        <label class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-200 dark:border-blue-800/30 rounded-xl cursor-pointer hover:bg-gradient-to-r hover:from-blue-100 hover:to-indigo-100 dark:hover:from-blue-800/30 dark:hover:to-indigo-800/30 transition-all">
                            <input type="radio" name="payment_method" value="zalopay" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                            <div class="ml-4 flex items-center gap-3">
                                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">Z</span>
                                </div>
                                <div>
                                    <div class="font-medium text-slate-900 dark:text-slate-100">ZaloPay</div>
                                    <div class="text-sm text-slate-600 dark:text-slate-400">Thanh toán qua ví điện tử ZaloPay</div>
                                </div>
                            </div>
                        </label>

                        <!-- Bank Transfer -->
                        <label class="flex items-center p-4 bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/20 dark:to-green-900/20 border border-emerald-200 dark:border-emerald-800/30 rounded-xl cursor-pointer hover:bg-gradient-to-r hover:from-emerald-100 hover:to-green-100 dark:hover:from-emerald-800/30 dark:hover:to-green-800/30 transition-all">
                            <input type="radio" name="payment_method" value="bank_transfer" class="w-4 h-4 text-emerald-600 border-gray-300 focus:ring-emerald-500">
                            <div class="ml-4 flex items-center gap-3">
                                <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                                </svg>
                                <div>
                                    <div class="font-medium text-slate-900 dark:text-slate-100">Chuyển khoản ngân hàng</div>
                                    <div class="text-sm text-slate-600 dark:text-slate-400">Chuyển khoản trực tiếp qua ngân hàng</div>
                                </div>
                            </div>
                        </label>

                        <!-- COD -->
                        <label class="flex items-center p-4 bg-gradient-to-r from-amber-50 to-yellow-50 dark:from-amber-900/20 dark:to-yellow-900/20 border border-amber-200 dark:border-amber-800/30 rounded-xl cursor-pointer hover:bg-gradient-to-r hover:from-amber-100 hover:to-yellow-100 dark:hover:from-amber-800/30 dark:hover:to-yellow-800/30 transition-all">
                            <input type="radio" name="payment_method" value="cod" class="w-4 h-4 text-amber-600 border-gray-300 focus:ring-amber-500" checked>
                            <div class="ml-4 flex items-center gap-3">
                                <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <div>
                                    <div class="font-medium text-slate-900 dark:text-slate-100">Thanh toán khi nhận hàng (COD)</div>
                                    <div class="text-sm text-slate-600 dark:text-slate-400">Thanh toán bằng tiền mặt khi nhận hàng</div>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Right Column - Product Summary -->
            <div class="lg:col-span-1">
                <div class="backdrop-blur-sm bg-white/40 dark:bg-white/10 rounded-2xl p-6 border border-white/50 dark:border-white/20 shadow-lg sticky top-8">
                    <h2 class="text-xl font-semibold text-slate-900 dark:text-slate-200 mb-6 flex items-center gap-3">
                        <svg class="w-5 h-5 text-brand-600 dark:text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        Sản phẩm đặt mua
                    </h2>

                    <!-- Product Item -->
                    <div class="mb-6">
                        <div class="flex items-center gap-4 p-4 bg-slate-50/80 dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700">
                            <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}" 
                                 class="w-20 h-20 object-cover rounded-lg">
                            <div class="flex-1 min-w-0">
                                <h3 class="font-medium text-slate-900 dark:text-slate-100 mb-1">{{ $product->name }}</h3>
                                <p class="text-sm text-slate-600 dark:text-slate-400 mb-1">{{ $product->volume_ml }}ml</p>
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-medium text-slate-900 dark:text-slate-100">
                                        {{ number_format($product->final_price, 0, ',', '.') }}đ
                                    </span>
                                    <span class="text-sm text-slate-600 dark:text-slate-400">× {{ $cartItem->quantity }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="border-t border-slate-200 dark:border-slate-700 pt-4 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-600 dark:text-slate-400">Tạm tính</span>
                            <span class="font-medium text-slate-900 dark:text-slate-100">{{ number_format($total, 0, ',', '.') }}đ</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-600 dark:text-slate-400">Phí vận chuyển</span>
                            <span class="font-medium text-slate-900 dark:text-slate-100">30.000đ</span>
                        </div>
                        <div class="border-t border-slate-200 dark:border-slate-700 pt-3">
                            <div class="flex justify-between">
                                <span class="text-lg font-semibold text-slate-900 dark:text-slate-100">Tổng cộng</span>
                                <span class="text-xl font-bold text-brand-600 dark:text-brand-400">{{ number_format($total + 30000, 0, ',', '.') }}đ</span>
                            </div>
                        </div>
                    </div>

                    <!-- Place Order Button -->
                    <button type="submit" class="w-full mt-6 px-6 py-4 bg-gradient-to-r from-brand-600 to-brand-700 hover:from-brand-700 hover:to-brand-800 text-white rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-[1.02]">
                        <div class="flex items-center justify-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7"></path>
                            </svg>
                            Mua ngay
                        </div>
                    </button>

                    <!-- Security Notice -->
                    <div class="mt-4 p-3 bg-green-50/80 dark:bg-green-900/20 border border-green-200 dark:border-green-800/30 rounded-lg">
                        <div class="flex items-center gap-2 text-green-700 dark:text-green-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            <span class="text-xs font-medium">Thanh toán an toàn & bảo mật</span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection