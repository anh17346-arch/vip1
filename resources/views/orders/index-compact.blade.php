@extends('layouts.app')

@section('title', __('app.my_orders') . ' - Perfume Luxury')

@section('content')
<!-- Modern Unified Background -->
<div class="min-h-screen relative overflow-hidden">
  <!-- Animated Background -->
  <div class="fixed inset-0 -z-10">
    <div class="absolute inset-0 bg-gradient-to-br from-slate-50 via-blue-50/60 via-purple-50/60 to-pink-50/60 dark:from-slate-900 dark:via-blue-900/30 dark:via-purple-900/30 dark:to-pink-900/30"></div>
    <div class="absolute top-20 left-10 w-64 h-64 bg-gradient-to-r from-blue-400/10 to-purple-400/10 dark:from-blue-400/5 dark:to-purple-400/5 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl animate-blob"></div>
    <div class="absolute top-40 right-20 w-72 h-72 bg-gradient-to-r from-pink-400/10 to-rose-400/10 dark:from-pink-400/5 dark:to-rose-400/5 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl animate-blob animation-delay-2000"></div>
    <div class="absolute bottom-32 left-1/3 w-80 h-80 bg-gradient-to-r from-cyan-400/10 to-teal-400/10 dark:from-cyan-400/5 dark:to-teal-400/5 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl animate-blob animation-delay-4000"></div>
  </div>

  @include('partials.toast')

<div class="relative container mx-auto px-4 py-6">
    
    <!-- Compact Header -->
    <div class="mb-6">
        <nav class="mb-3">
            <ol class="flex items-center space-x-2 text-sm text-slate-600 dark:text-slate-400">
                <li><a href="{{ route('trangchu') }}" class="hover:text-brand-600">{{ __('app.home') }}</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-slate-900 dark:text-slate-200 font-medium">{{ __('app.my_orders') }}</li>
            </ol>
        </nav>
        
        <h1 class="text-2xl font-bold text-slate-800 dark:text-slate-200 mb-1">{{ __('app.my_orders') }}</h1>
        <p class="text-sm text-slate-600 dark:text-slate-400">{{ __('app.manage_track_orders') }}</p>
    </div>

    <!-- Compact Filters -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-4 mb-6">
        <form method="GET" class="grid grid-cols-2 md:grid-cols-4 gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('app.order_number_placeholder') }}"
                   class="px-3 py-2 bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-1 focus:ring-brand-500 text-sm">
            
            <select name="status" class="px-3 py-2 bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-1 focus:ring-brand-500 text-sm">
                <option value="">{{ __('app.all_status') }}</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>{{ __('app.pending') }}</option>
                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>{{ __('app.processing') }}</option>
                <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>{{ __('app.shipped') }}</option>
                <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>{{ __('app.delivered') }}</option>
            </select>
            
            <select name="payment_status" class="px-3 py-2 bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-1 focus:ring-brand-500 text-sm">
                <option value="">{{ __('app.all_payments') }}</option>
                <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>{{ __('app.payment_pending') }}</option>
                <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>{{ __('app.payment_paid') }}</option>
            </select>
            
            <button type="submit" class="px-3 py-2 bg-brand-600 hover:bg-brand-700 text-white rounded-lg font-medium transition-all text-sm">
                {{ __('app.filter') }}
            </button>
        </form>
    </div>

    <!-- Orders Grid Layout -->
    @if($orders->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4">
            @foreach($orders as $order)
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden hover:shadow-lg transition-all duration-300">
                    <!-- Order Header -->
                    <div class="p-4 border-b border-slate-200 dark:border-slate-700">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-sm font-semibold text-slate-900 dark:text-slate-100">
                                #{{ $order->order_number }}
                            </h3>
                            <p class="text-lg font-bold text-slate-900 dark:text-slate-100">{{ $order->formatted_total }}</p>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <p class="text-xs text-slate-600 dark:text-slate-400">
                                {{ $order->created_at->format('d/m/Y H:i') }}
                            </p>
                            <div class="flex gap-1">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $order->status_badge_class }}">
                                    {{ $order->status_display }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Order Content -->
                    <div class="p-4">
                        <!-- Mini Items Preview -->
                        <div class="flex items-center gap-2 mb-3">
                            @foreach($order->items->take(3) as $item)
                                <img src="{{ $item->product->main_image_url }}" alt="{{ $item->product->name }}" 
                                     class="w-8 h-8 object-cover rounded border border-slate-200 dark:border-slate-600">
                            @endforeach
                            @if($order->items->count() > 3)
                                <div class="w-8 h-8 bg-slate-100 dark:bg-slate-700 rounded flex items-center justify-center">
                                    <span class="text-xs font-medium text-slate-600 dark:text-slate-400">+{{ $order->items->count() - 3 }}</span>
                                </div>
                            @endif
                            <span class="text-xs text-slate-600 dark:text-slate-400 ml-1">{{ $order->items->count() }} {{ __('app.products') }}</span>
                        </div>

                        <!-- Payment & Actions -->
                        <div class="space-y-2">
                            <p class="text-xs text-slate-600 dark:text-slate-400">{{ $order->payment_method_display }}</p>
                            
                            <div class="grid grid-cols-2 gap-2">
                                <!-- View Details -->
                                <a href="{{ route('orders.show', $order) }}" 
                                   class="inline-flex items-center justify-center px-3 py-2 bg-brand-600 hover:bg-brand-700 text-white rounded-lg font-medium transition-all duration-300 text-xs">
                                    {{ __('app.view_details') }}
                                </a>

                                <!-- Cancel/Reorder/Invoice -->
                                @if($order->status === 'pending')
                                    <form method="POST" action="{{ route('orders.cancel', $order) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" onclick="return confirm('{{ __('app.confirm_cancel_order') }}')"
                                                class="w-full inline-flex items-center justify-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-all duration-300 text-xs">
                                            {{ __('app.cancel') }}
                                        </button>
                                    </form>
                                @elseif($order->status === 'delivered')
                                    <form method="POST" action="{{ route('orders.reorder', $order) }}">
                                        @csrf
                                        <button type="submit"
                                                class="w-full inline-flex items-center justify-center px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-medium transition-all duration-300 text-xs">
                                            {{ __('app.reorder') }}
                                        </button>
                                    </form>
                                @else
                                    <span class="inline-flex items-center justify-center px-3 py-2 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-400 rounded-lg text-xs">
                                        {{ $order->payment_status_display }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Compact Pagination -->
        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    @else
        <!-- Compact Empty State -->
        <div class="text-center py-12">
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-8 max-w-md mx-auto">
                <div class="text-slate-400 dark:text-slate-500 mb-4">
                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-slate-900 dark:text-slate-100 mb-2">{{ __('app.no_orders_yet') }}</h3>
                <p class="text-sm text-slate-600 dark:text-slate-400 mb-6">{{ __('app.no_orders_description') }}</p>
                <a href="{{ route('products.index') }}" 
                   class="inline-block px-6 py-3 bg-brand-600 hover:bg-brand-700 text-white rounded-lg font-semibold transition-colors">
                    🛍️ {{ __('app.start_shopping') }}
                </a>
            </div>
        </div>
    @endif
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
.animation-delay-2000 { animation-delay: 2s; }
.animation-delay-4000 { animation-delay: 4s; }
</style>
@endsection