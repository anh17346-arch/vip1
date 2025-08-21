@extends('layouts.app')

@section('title', $product->name . ' - Perfume Luxury')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-slate-50 to-slate-100 dark:from-slate-900 dark:to-slate-950">
    <div class="container mx-auto px-4 py-8">
        <!-- Enhanced Header Section -->
        <div class="mb-8 space-y-4">
            <!-- Breadcrumb Navigation -->
            <nav class="backdrop-blur-sm bg-white/30 dark:bg-white/10 rounded-xl px-4 py-2 border border-white/40 dark:border-white/20">
                <ol class="flex items-center space-x-2 text-sm text-slate-600 dark:text-slate-400">
                    <li><a href="{{ route('trangchu') }}" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors font-medium">{{ __('app.home') }}</a></li>
                    <li><span class="mx-2 text-slate-400">/</span></li>
                    <li><a href="{{ route('products.index') }}" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors font-medium">{{ __('app.products') }}</a></li>
                    <li><span class="mx-2 text-slate-400">/</span></li>
                    <li><a href="{{ route('products.category', $product->category) }}" class="hover:text-brand-600 dark:hover:text-brand-400 transition-colors font-medium">{{ $product->category->display_name }}</a></li>
                    <li><span class="mx-2 text-slate-400">/</span></li>
                    <li class="text-slate-900 dark:text-slate-200 font-semibold">{{ Str::limit($product->display_name, 30) }}</li>
                </ol>
            </nav>

            <!-- Product Quick Info Bar -->
            <div class="flex flex-wrap items-center justify-between gap-4 backdrop-blur-sm bg-white/20 dark:bg-white/5 rounded-xl px-6 py-4 border border-white/30 dark:border-white/10">
                <div class="flex items-center gap-4">
                    <!-- Product ID -->
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wide">ID:</span>
                        <span class="text-sm font-mono font-semibold text-slate-700 dark:text-slate-300">#{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    
                    <!-- SKU -->
                    @if($product->sku)
                        <div class="flex items-center gap-2">
                            <span class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wide">SKU:</span>
                            <span class="text-sm font-mono font-semibold text-slate-700 dark:text-slate-300">{{ $product->sku }}</span>
                        </div>
                    @endif

                    <!-- Availability Status -->
                    <div class="flex items-center gap-2">
                        @if($product->stock > 0)
                            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                            <span class="text-sm font-semibold text-green-600 dark:text-green-400">{{ __('app.in_stock') }}</span>
                        @else
                            <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                            <span class="text-sm font-semibold text-red-600 dark:text-red-400">{{ __('app.out_of_stock') }}</span>
                        @endif
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="flex items-center gap-6">
                    <!-- Views -->
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <span class="text-sm font-semibold text-blue-700 dark:text-blue-300">{{ $product->formatted_views }}</span>
                    </div>

                    <!-- Sales -->
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <span class="text-sm font-semibold text-emerald-700 dark:text-emerald-300">{{ $product->formatted_sold }}</span>
                    </div>

                    <!-- Rating Placeholder -->
                    <div class="flex items-center gap-1">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-3 h-3 {{ $i <= 4 ? 'text-yellow-400' : 'text-slate-300 dark:text-slate-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        @endfor
                        <span class="text-xs text-slate-500 dark:text-slate-400 ml-1">(4.0)</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Product Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            <!-- Enhanced Product Image Gallery - 1 column -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Main Image Container with enhanced features -->
                <div class="relative group">
                    <!-- Image Counter Badge -->
                    <div class="absolute top-4 left-4 z-20 backdrop-blur-sm bg-black/50 text-white px-3 py-1.5 rounded-full text-sm font-semibold">
                        <span id="current-image-number">1</span> / <span id="total-images">{{ ($product->main_image ? 1 : 0) + $product->images->count() }}</span>
                    </div>

                    <!-- Zoom Toggle Button -->
                    <button type="button" onclick="toggleZoom()" 
                            class="absolute top-4 right-4 z-20 backdrop-blur-sm bg-black/50 hover:bg-black/70 text-white rounded-full w-10 h-10 flex items-center justify-center transition-all duration-300 hover:scale-110"
                            title="Toggle zoom">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                        </svg>
                    </button>

                    <!-- Main Image Display -->
                    <div class="aspect-square overflow-hidden rounded-2xl shadow-2xl border border-white/40 dark:border-white/20 bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-800 dark:to-slate-900">
                        <img id="main-product-image" src="{{ $product->main_image_url }}" 
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover cursor-zoom-in transition-all duration-500 hover:scale-105 group-hover:shadow-2xl">
                        
                        <!-- Loading Skeleton -->
                        <div id="image-skeleton" class="hidden absolute inset-0 bg-gradient-to-r from-slate-200 via-slate-100 to-slate-200 dark:from-slate-700 dark:via-slate-600 dark:to-slate-700 animate-pulse"></div>
                    </div>
                    
                    <!-- Enhanced Navigation Arrows -->
                    <button type="button" aria-label="{{ __('app.previous_image') }}" onclick="galleryPrev()" 
                            class="absolute left-3 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 backdrop-blur-sm bg-gradient-to-r from-white/90 to-white/80 dark:from-slate-800/90 dark:to-slate-800/80 hover:from-brand-50 hover:to-brand-100 dark:hover:from-brand-900/50 dark:hover:to-brand-800/50 text-slate-700 dark:text-slate-200 hover:text-brand-600 dark:hover:text-brand-400 rounded-full w-12 h-12 flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-110 border border-white/50 dark:border-slate-700/50">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button type="button" aria-label="{{ __('app.next_image') }}" onclick="galleryNext()" 
                            class="absolute right-3 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 backdrop-blur-sm bg-gradient-to-l from-white/90 to-white/80 dark:from-slate-800/90 dark:to-slate-800/80 hover:from-brand-50 hover:to-brand-100 dark:hover:from-brand-900/50 dark:hover:to-brand-800/50 text-slate-700 dark:text-slate-200 hover:text-brand-600 dark:hover:text-brand-400 rounded-full w-12 h-12 flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-110 border border-white/50 dark:border-slate-700/50">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <!-- Image Progress Indicator -->
                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-1.5">
                        @php $imageCount = ($product->main_image ? 1 : 0) + $product->images->count(); @endphp
                        @for($i = 0; $i < $imageCount; $i++)
                            <div class="progress-dot w-2 h-2 rounded-full bg-white/50 transition-all duration-300 {{ $i === 0 ? 'bg-white scale-125' : '' }}" data-index="{{ $i }}"></div>
                        @endfor
                    </div>
                </div>
                
                <!-- Enhanced Thumbnail Gallery -->
                @if($product->has_gallery && ($product->images->count() > 0 || $product->main_image))
                    <div class="space-y-3">
                        <!-- Gallery Title -->
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wide">{{ __('app.gallery') }}</h3>
                            <span class="text-xs text-slate-500 dark:text-slate-400">{{ ($product->main_image ? 1 : 0) + $product->images->count() }} {{ __('app.images') }}</span>
                        </div>

                        <!-- Thumbnail Grid -->
                        <div id="thumbnails" class="grid grid-cols-4 gap-3">
                            <!-- Main Image Thumbnail -->
                            @if($product->main_image)
                                <button type="button" 
                                        data-index="0"
                                        data-image-url="{{ $product->main_image_url }}"
                                        onclick="changeMainImage(this.dataset.imageUrl, this, 0)"
                                        class="group relative aspect-square overflow-hidden rounded-xl border-2 border-brand-500 dark:border-brand-400 hover:border-brand-600 dark:hover:border-brand-300 transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl main-image-thumb bg-gradient-to-br from-brand-50 to-brand-100 dark:from-brand-900/20 dark:to-brand-800/20">
                                    <img src="{{ $product->main_image_url }}" 
                                         alt="{{ $product->name }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                    
                                    <!-- Main Badge -->
                                    <div class="absolute top-1 left-1 backdrop-blur-sm bg-brand-500/80 text-white text-xs px-1.5 py-0.5 rounded-md font-semibold">
                                        {{ __('app.main') }}
                                    </div>
                                    
                                    <!-- Hover Overlay -->
                                    <div class="absolute inset-0 bg-brand-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </div>
                                </button>
                            @endif
                            
                            <!-- Gallery Images -->
                            @foreach($product->images as $idx => $image)
                                @php $thumbnailIndex = ($product->main_image ? 1 : 0) + $idx; @endphp
                                <button type="button" 
                                        data-index="{{ $thumbnailIndex }}"
                                        data-image-url="{{ $image->image_url }}"
                                        onclick="changeMainImage(this.dataset.imageUrl, this, {{ $thumbnailIndex }})"
                                        class="group relative aspect-square overflow-hidden rounded-xl border-2 border-slate-200 dark:border-slate-700 hover:border-brand-500 dark:hover:border-brand-400 transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-900">
                                    <img src="{{ $image->thumbnail_url }}" 
                                         alt="{{ $image->alt_text ?? $product->name }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                    
                                    <!-- Image Number Badge -->
                                    <div class="absolute top-1 left-1 backdrop-blur-sm bg-slate-700/80 text-white text-xs px-1.5 py-0.5 rounded-md font-semibold">
                                        {{ $thumbnailIndex + 1 }}
                                    </div>
                                    
                                    <!-- Hover Overlay -->
                                    <div class="absolute inset-0 bg-slate-900/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Enhanced Product Info - 2 columns -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Product Header Section -->
                <div class="backdrop-blur-sm bg-white/40 dark:bg-white/10 rounded-2xl p-8 border border-white/50 dark:border-white/20 shadow-lg">
                    <!-- Category & Brand Tags -->
                    <div class="flex flex-wrap items-center gap-3 mb-6">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-brand-600 dark:text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            <span class="inline-block px-4 py-2 bg-gradient-to-r from-brand-100 to-brand-50 dark:from-brand-900/30 dark:to-brand-800/20 text-brand-700 dark:text-brand-300 rounded-full text-sm font-semibold border border-brand-200 dark:border-brand-800/50 shadow-sm">
                                {{ $product->category->display_name }}
                            </span>
                        </div>
                        
                        @if($product->brand)
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-slate-600 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <span class="inline-block px-4 py-2 bg-gradient-to-r from-slate-100 to-slate-50 dark:from-slate-700 dark:to-slate-800 text-slate-600 dark:text-slate-400 rounded-full text-sm font-medium border border-slate-200 dark:border-slate-600 shadow-sm">
                                    {{ $product->brand }}
                                </span>
                            </div>
                        @endif

                        <!-- New/Featured/Sale Badges -->
                        @if($product->is_on_sale)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gradient-to-r from-rose-100 to-red-100 dark:from-rose-900/30 dark:to-red-900/30 text-rose-700 dark:text-rose-300 rounded-full text-xs font-bold border border-rose-200 dark:border-rose-800/50 shadow-sm animate-pulse">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path>
                                </svg>
                                {{ __('app.on_sale') }}
                            </span>
                        @endif
                    </div>

                    <!-- Product Name with Typography Enhancement -->
                    <div class="space-y-3 mb-6">
                        <h1 class="text-4xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 dark:from-slate-100 dark:to-slate-300 bg-clip-text text-transparent leading-tight">
                            {{ $product->display_name }}
                        </h1>
                        
                        <!-- Product Subtitle/Short Description -->
                        @if($product->short_description)
                            <p class="text-lg text-slate-600 dark:text-slate-400 leading-relaxed">{{ $product->short_description }}</p>
                        @endif
                    </div>

                    <!-- Enhanced Price Section -->
                    <div class="backdrop-blur-sm bg-gradient-to-r from-slate-50/50 to-white/50 dark:from-slate-800/50 dark:to-slate-900/50 rounded-xl p-6 border border-slate-200/50 dark:border-slate-700/50">
                        @if($product->is_on_sale)
                            <div class="space-y-3">
                                <!-- Sale Price -->
                                <div class="flex items-baseline gap-4">
                                    <span class="text-4xl font-bold bg-gradient-to-r from-rose-600 to-red-600 bg-clip-text text-transparent">
                                        @if(app()->getLocale() === 'en')
                                            ${{ number_format($product->final_price / 25000, 2) }}
                                        @else
                                            {{ number_format($product->final_price, 0, ',', '.') }}đ
                                        @endif
                                    </span>
                                    <span class="text-xl text-slate-400 line-through">
                                        @if(app()->getLocale() === 'en')
                                            ${{ number_format($product->price / 25000, 2) }}
                                        @else
                                            {{ number_format($product->price, 0, ',', '.') }}đ
                                        @endif
                                    </span>
                                </div>
                                
                                <!-- Savings Information -->
                                <div class="flex items-center gap-4">
                                    <span class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-rose-100 to-red-100 dark:from-rose-900/30 dark:to-red-900/30 text-rose-700 dark:text-rose-300 rounded-full text-sm font-bold border border-rose-200 dark:border-rose-800/50 shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                        -{{ $product->discount_percentage }}%
                                    </span>
                                    <span class="text-sm text-emerald-600 dark:text-emerald-400 font-semibold">
                                        {{ __('app.you_save') }} 
                                        @if(app()->getLocale() === 'en')
                                            ${{ number_format(($product->price - $product->final_price) / 25000, 2) }}
                                        @else
                                            {{ number_format($product->price - $product->final_price, 0, ',', '.') }}đ
                                        @endif
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="flex items-baseline gap-3">
                                <span class="text-4xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 dark:from-slate-100 dark:to-slate-300 bg-clip-text text-transparent">
                                    @if(app()->getLocale() === 'en')
                                        ${{ number_format($product->price / 25000, 2) }}
                                    @else
                                        {{ number_format($product->price, 0, ',', '.') }}đ
                                    @endif
                                </span>
                                <span class="text-sm text-slate-500 dark:text-slate-400 uppercase tracking-wide">{{ __('app.regular_price') }}</span>
                            </div>
                        @endif
                        
                        <!-- Price per ml calculation -->
                        @if($product->volume_ml)
                            <div class="mt-3 pt-3 border-t border-slate-200 dark:border-slate-700">
                                <span class="text-sm text-slate-500 dark:text-slate-400">
                                    {{ __('app.price_per_ml') }}: 
                                    <span class="font-semibold text-slate-700 dark:text-slate-300">
                                        @if(app()->getLocale() === 'en')
                                            ${{ number_format($product->final_price / 25000 / $product->volume_ml, 2) }}/ml
                                        @else
                                            {{ number_format($product->final_price / $product->volume_ml, 0, ',', '.') }}đ/ml
                                        @endif
                                    </span>
                                </span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Enhanced Product Specifications -->
                <div class="backdrop-blur-sm bg-white/30 dark:bg-white/10 rounded-2xl p-8 border border-white/40 dark:border-white/20 shadow-lg">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-5 h-5 text-slate-600 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-slate-900 dark:text-slate-200">{{ __('app.product_specifications') }}</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Basic Information -->
                        <div class="space-y-4">
                            <h4 class="text-sm font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider border-b border-slate-200 dark:border-slate-700 pb-2">{{ __('app.basic_info') }}</h4>
                            
                            <!-- Volume -->
                            <div class="flex items-center justify-between py-2 border-b border-slate-100 dark:border-slate-800">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                    </svg>
                                    <span class="text-sm text-slate-600 dark:text-slate-400 font-medium">{{ __('app.volume') }}</span>
                                </div>
                                <span class="font-semibold text-slate-900 dark:text-slate-100 bg-blue-50 dark:bg-blue-900/20 px-3 py-1 rounded-full text-sm">{{ $product->volume_ml }}ml</span>
                            </div>
                            
                            <!-- Gender -->
                            <div class="flex items-center justify-between py-2 border-b border-slate-100 dark:border-slate-800">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span class="text-sm text-slate-600 dark:text-slate-400 font-medium">{{ __('app.gender') }}</span>
                                </div>
                                <span class="font-semibold text-slate-900 dark:text-slate-100 bg-purple-50 dark:bg-purple-900/20 px-3 py-1 rounded-full text-sm">
                                    @switch($product->gender)
                                        @case('male') {{ __('app.male') }} @break
                                        @case('female') {{ __('app.female') }} @break
                                        @default {{ __('app.unisex') }}
                                    @endswitch
                                </span>
                            </div>

                            <!-- Concentration -->
                            @if($product->concentration)
                                <div class="flex items-center justify-between py-2 border-b border-slate-100 dark:border-slate-800">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                        <span class="text-sm text-slate-600 dark:text-slate-400 font-medium">{{ __('app.concentration') }}</span>
                                    </div>
                                    <span class="font-semibold text-slate-900 dark:text-slate-100 bg-amber-50 dark:bg-amber-900/20 px-3 py-1 rounded-full text-sm">{{ $product->concentration }}</span>
                                </div>
                            @endif

                            <!-- Origin -->
                            @if($product->origin)
                                <div class="flex items-center justify-between py-2">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span class="text-sm text-slate-600 dark:text-slate-400 font-medium">{{ __('app.origin') }}</span>
                                    </div>
                                    <span class="font-semibold text-slate-900 dark:text-slate-100 bg-green-50 dark:bg-green-900/20 px-3 py-1 rounded-full text-sm">{{ $product->origin }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Inventory & Status -->
                        <div class="space-y-4">
                            <h4 class="text-sm font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wider border-b border-slate-200 dark:border-slate-700 pb-2">{{ __('app.availability') }}</h4>
                            
                            <!-- Stock Status -->
                            <div class="flex items-center justify-between py-2 border-b border-slate-100 dark:border-slate-800">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 {{ $product->stock > 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                    <span class="text-sm text-slate-600 dark:text-slate-400 font-medium">{{ __('app.stock_status') }}</span>
                                </div>
                                @if($product->stock > 0)
                                    <span class="inline-flex items-center gap-2 font-semibold text-green-700 dark:text-green-300 bg-green-50 dark:bg-green-900/20 px-3 py-1 rounded-full text-sm">
                                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                                        @if(app()->getLocale() === 'en')
                                            In stock ({{ $product->stock }})
                                        @else
                                            Còn hàng ({{ $product->stock }})
                                        @endif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-2 font-semibold text-red-700 dark:text-red-300 bg-red-50 dark:bg-red-900/20 px-3 py-1 rounded-full text-sm">
                                        <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                        {{ __('app.out_of_stock') }}
                                    </span>
                                @endif
                            </div>

                            <!-- SKU -->
                            @if($product->sku)
                                <div class="flex items-center justify-between py-2 border-b border-slate-100 dark:border-slate-800">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-slate-600 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                        </svg>
                                        <span class="text-sm text-slate-600 dark:text-slate-400 font-medium">SKU</span>
                                    </div>
                                    <span class="font-mono font-semibold text-slate-900 dark:text-slate-100 bg-slate-50 dark:bg-slate-800 px-3 py-1 rounded-full text-sm">{{ $product->sku }}</span>
                                </div>
                            @endif

                            <!-- Product ID -->
                            <div class="flex items-center justify-between py-2">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-slate-600 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                                    </svg>
                                    <span class="text-sm text-slate-600 dark:text-slate-400 font-medium">{{ __('app.product_id') }}</span>
                                </div>
                                <span class="font-mono font-semibold text-slate-900 dark:text-slate-100 bg-slate-50 dark:bg-slate-800 px-3 py-1 rounded-full text-sm">#{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Analytics & Performance Section -->
                <div class="space-y-6">
                    <!-- Section Title -->
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-slate-600 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-slate-900 dark:text-slate-200">{{ __('app.product_analytics') }}</h3>
                    </div>

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Views Analytics -->
                        <div class="group backdrop-blur-sm bg-gradient-to-br from-blue-50/80 to-indigo-100/80 dark:from-blue-900/20 dark:to-indigo-900/30 rounded-2xl p-8 border border-blue-200/50 dark:border-blue-800/30 shadow-lg hover:shadow-2xl transition-all duration-500 hover:scale-[1.02] relative overflow-hidden">
                            <!-- Background Pattern -->
                            <div class="absolute inset-0 opacity-10">
                                <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <pattern id="views-pattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                                            <circle cx="10" cy="10" r="1" fill="currentColor" class="text-blue-400"/>
                                        </pattern>
                                    </defs>
                                    <rect width="100%" height="100%" fill="url(#views-pattern)"/>
                                </svg>
                            </div>

                            <div class="relative flex items-center justify-between">
                                <div class="space-y-3">
                                    <div class="flex items-center gap-3">
                                        <div class="p-3 bg-gradient-to-r from-blue-100 to-blue-200 dark:from-blue-800/50 dark:to-blue-700/50 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                            <svg class="w-7 h-7 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-blue-600 dark:text-blue-400 uppercase tracking-wider">{{ __('app.total_views') }}</p>
                                            <p class="text-3xl font-bold text-blue-800 dark:text-blue-200 group-hover:scale-105 transition-transform duration-300">{{ $product->formatted_views }}</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Popularity Indicator -->
                                    <div class="flex items-center gap-2">
                                        <div class="flex">
                                            @for($i = 1; $i <= 5; $i++)
                                                <div class="w-2 h-2 rounded-full mr-1 {{ $i <= min(5, ceil($product->views / 200)) ? 'bg-blue-500' : 'bg-blue-200 dark:bg-blue-800' }} transition-colors duration-300"></div>
                                            @endfor
                                        </div>
                                        <span class="text-xs text-blue-600 dark:text-blue-400 font-medium">{{ __('app.popularity_level') }}</span>
                                    </div>
                                </div>

                                <!-- Trending Arrow -->
                                <div class="text-blue-600/20 dark:text-blue-400/20 group-hover:text-blue-600/40 dark:group-hover:text-blue-400/40 transition-colors duration-300">
                                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Sales Analytics -->
                        <div class="group backdrop-blur-sm bg-gradient-to-br from-emerald-50/80 to-green-100/80 dark:from-emerald-900/20 dark:to-green-900/30 rounded-2xl p-8 border border-emerald-200/50 dark:border-emerald-800/30 shadow-lg hover:shadow-2xl transition-all duration-500 hover:scale-[1.02] relative overflow-hidden">
                            <!-- Background Pattern -->
                            <div class="absolute inset-0 opacity-10">
                                <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <pattern id="sales-pattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                                            <rect x="8" y="8" width="4" height="4" fill="currentColor" class="text-emerald-400"/>
                                        </pattern>
                                    </defs>
                                    <rect width="100%" height="100%" fill="url(#sales-pattern)"/>
                                </svg>
                            </div>

                            <div class="relative flex items-center justify-between">
                                <div class="space-y-3">
                                    <div class="flex items-center gap-3">
                                        <div class="p-3 bg-gradient-to-r from-emerald-100 to-emerald-200 dark:from-emerald-800/50 dark:to-emerald-700/50 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                                            <svg class="w-7 h-7 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider">{{ __('app.total_sold') }}</p>
                                            <p class="text-3xl font-bold text-emerald-800 dark:text-emerald-200 group-hover:scale-105 transition-transform duration-300">{{ $product->formatted_sold }}</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Sales Performance Indicator -->
                                    <div class="flex items-center gap-2">
                                        <div class="flex">
                                            @for($i = 1; $i <= 5; $i++)
                                                <div class="w-2 h-2 rounded-full mr-1 {{ $i <= min(5, ceil($product->sold / 50)) ? 'bg-emerald-500' : 'bg-emerald-200 dark:bg-emerald-800' }} transition-colors duration-300"></div>
                                            @endfor
                                        </div>
                                        <span class="text-xs text-emerald-600 dark:text-emerald-400 font-medium">{{ __('app.sales_performance') }}</span>
                                    </div>
                                </div>

                                <!-- Success Icon -->
                                <div class="text-emerald-600/20 dark:text-emerald-400/20 group-hover:text-emerald-600/40 dark:group-hover:text-emerald-400/40 transition-colors duration-300">
                                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Metrics Row -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <!-- Conversion Rate -->
                        <div class="backdrop-blur-sm bg-white/40 dark:bg-white/10 rounded-xl p-4 border border-white/50 dark:border-white/20 text-center">
                            <div class="text-2xl font-bold text-slate-900 dark:text-slate-100">
                                {{ $product->views > 0 ? number_format(($product->sold / $product->views) * 100, 1) : '0.0' }}%
                            </div>
                            <div class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wide font-medium">{{ __('app.conversion_rate') }}</div>
                        </div>

                        <!-- Stock Level -->
                        <div class="backdrop-blur-sm bg-white/40 dark:bg-white/10 rounded-xl p-4 border border-white/50 dark:border-white/20 text-center">
                            <div class="text-2xl font-bold text-slate-900 dark:text-slate-100">{{ $product->stock }}</div>
                            <div class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wide font-medium">{{ __('app.in_stock') }}</div>
                        </div>

                        <!-- Days Listed -->
                        <div class="backdrop-blur-sm bg-white/40 dark:bg-white/10 rounded-xl p-4 border border-white/50 dark:border-white/20 text-center">
                            <div class="text-2xl font-bold text-slate-900 dark:text-slate-100">{{ $product->created_at->diffInDays(now()) }}</div>
                            <div class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wide font-medium">{{ __('app.days_listed') }}</div>
                        </div>

                        <!-- Rating -->
                        <div class="backdrop-blur-sm bg-white/40 dark:bg-white/10 rounded-xl p-4 border border-white/50 dark:border-white/20 text-center">
                            <div class="text-2xl font-bold text-slate-900 dark:text-slate-100">4.0</div>
                            <div class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wide font-medium">{{ __('app.rating') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Purchase Action Panel -->
                <div class="backdrop-blur-sm bg-gradient-to-br from-white/50 to-white/30 dark:from-white/15 dark:to-white/10 rounded-2xl p-8 border border-white/50 dark:border-white/20 shadow-xl">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-5 h-5 text-slate-600 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8m-8 0V9"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-slate-900 dark:text-slate-200">{{ __('app.purchase_options') }}</h3>
                    </div>

                    @if($product->stock > 0)
                        <!-- Purchase Confidence Indicators -->
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <!-- Secure Purchase -->
                            <div class="flex items-center gap-2 p-3 bg-green-50/80 dark:bg-green-900/20 rounded-xl border border-green-200/50 dark:border-green-800/30">
                                <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                                <span class="text-xs font-semibold text-green-700 dark:text-green-300">{{ __('app.secure_payment') }}</span>
                            </div>

                            <!-- Fast Shipping -->
                            <div class="flex items-center gap-2 p-3 bg-blue-50/80 dark:bg-blue-900/20 rounded-xl border border-blue-200/50 dark:border-blue-800/30">
                                <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                <span class="text-xs font-semibold text-blue-700 dark:text-blue-300">{{ __('app.fast_shipping') }}</span>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('cart.add') }}" class="space-y-6">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            
                            <!-- Enhanced Quantity Selector -->
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                        </svg>
                                        {{ __('app.quantity') }}:
                                    </label>
                                    <span class="text-sm text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-slate-800 px-3 py-1 rounded-full">
                                        {{ __('app.available') }}: {{ $product->stock }}
                                    </span>
                                </div>
                                
                                <div class="flex items-center justify-center">
                                    <div class="flex items-center bg-white/60 dark:bg-slate-800/60 border border-slate-300 dark:border-slate-600 rounded-xl overflow-hidden shadow-inner backdrop-blur-sm">
                                        <button type="button" onclick="changeQuantity(-1)" 
                                                class="px-4 py-3 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors text-slate-600 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200 border-r border-slate-300 dark:border-slate-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 12H4"></path>
                                            </svg>
                                        </button>
                                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}"
                                               class="w-20 text-center border-0 focus:ring-0 bg-transparent text-slate-900 dark:text-slate-100 font-semibold text-lg py-3 focus:bg-white/80 dark:focus:bg-slate-700/80 transition-colors">
                                        <button type="button" onclick="changeQuantity(1)" 
                                                class="px-4 py-3 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors text-slate-600 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200 border-l border-slate-300 dark:border-slate-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Total Price Display -->
                                <div class="text-center">
                                    <span class="text-sm text-slate-500 dark:text-slate-400">{{ __('app.total_price') }}: </span>
                                    <span id="total-price" class="text-lg font-bold text-slate-900 dark:text-slate-100">
                                        @if(app()->getLocale() === 'en')
                                            ${{ number_format($product->final_price / 25000, 2) }}
                                        @else
                                            {{ number_format($product->final_price, 0, ',', '.') }}đ
                                        @endif
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Enhanced Add to Cart Button -->
                            <button type="submit" 
                                    class="group relative w-full px-8 py-5 bg-gradient-to-r from-brand-600 to-brand-700 hover:from-brand-700 hover:to-brand-800 text-white rounded-2xl font-bold text-lg transition-all duration-300 shadow-lg hover:shadow-2xl hover:scale-[1.02] overflow-hidden">
                                <!-- Shimmer Effect -->
                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                                
                                <div class="relative flex items-center justify-center gap-3">
                                    <svg class="w-6 h-6 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m0 0h8m-8 0V9"></path>
                                    </svg>
                                    <span>{{ __('app.add_to_cart') }}</span>
                                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </button>
                        </form>
                        
                        <!-- Secondary Actions -->
                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <!-- Add to Wishlist -->
                            <button class="group flex items-center justify-center gap-2 px-4 py-3 border-2 border-rose-300 dark:border-rose-700 text-rose-600 dark:text-rose-400 hover:bg-rose-600 hover:text-white dark:hover:bg-rose-600 dark:hover:text-white rounded-xl font-semibold transition-all duration-300 hover:scale-[1.02] bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm">
                                <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                <span>{{ __('app.wishlist') }}</span>
                            </button>

                            <!-- Share Product -->
                            <button class="group flex items-center justify-center gap-2 px-4 py-3 border-2 border-blue-300 dark:border-blue-700 text-blue-600 dark:text-blue-400 hover:bg-blue-600 hover:text-white dark:hover:bg-blue-600 dark:hover:text-white rounded-xl font-semibold transition-all duration-300 hover:scale-[1.02] bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm">
                                <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                </svg>
                                <span>{{ __('app.share') }}</span>
                            </button>
                        </div>
                    @else
                        <!-- Out of Stock State -->
                        <div class="text-center space-y-4">
                            <div class="p-6 bg-red-50/80 dark:bg-red-900/20 rounded-2xl border border-red-200 dark:border-red-800">
                                <svg class="w-12 h-12 text-red-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                                <h4 class="text-lg font-bold text-red-800 dark:text-red-200 mb-2">{{ __('app.out_of_stock') }}</h4>
                                <p class="text-sm text-red-600 dark:text-red-400">{{ __('app.notify_when_available') }}</p>
                            </div>
                            
                            <button class="w-full px-6 py-4 bg-slate-400 text-white rounded-xl font-semibold cursor-not-allowed opacity-75" disabled>
                                {{ __('app.currently_unavailable') }}
                            </button>
                        </div>
                    @endif

                    <!-- Stock Warning -->
                    @if($product->stock <= 10 && $product->stock > 0)
                        <div class="backdrop-blur-sm bg-gradient-to-r from-amber-50/80 to-orange-50/80 dark:from-amber-900/20 dark:to-orange-900/20 border border-amber-200 dark:border-amber-800 rounded-xl p-4 mt-6">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-amber-100 dark:bg-amber-800/30 rounded-full">
                                    <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-amber-800 dark:text-amber-200 text-sm">{{ __('app.limited_stock') }}</p>
                                    <p class="text-amber-700 dark:text-amber-300 text-xs">
                                        @if(app()->getLocale() === 'en')
                                            Only {{ $product->stock }} items left in stock!
                                        @else
                                            Chỉ còn {{ $product->stock }} sản phẩm trong kho!
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Enhanced Product Description & Technical Specifications -->
        @if($product->description)
            <div class="backdrop-blur-sm bg-white/30 dark:bg-white/10 rounded-2xl p-8 shadow-lg border border-white/40 dark:border-white/20 mb-12">
                <div class="flex items-center gap-3 mb-6">
                    <svg class="w-5 h-5 text-slate-600 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h2 class="text-2xl font-semibold text-slate-900 dark:text-slate-200">{{ __('app.product_description') }}</h2>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Main Description -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Description Content -->
                        <div class="prose prose-slate dark:prose-invert max-w-none text-base leading-relaxed">
                            <div class="bg-gradient-to-r from-slate-50 to-white dark:from-slate-800 dark:to-slate-900 rounded-xl p-6 border border-slate-200 dark:border-slate-700">
                                {!! nl2br(e($product->display_description)) !!}
                            </div>
                        </div>

                        <!-- Key Features -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-200 flex items-center gap-2">
                                <svg class="w-5 h-5 text-brand-600 dark:text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ __('app.key_features') }}
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Authentic Product -->
                                <div class="flex items-center gap-3 p-4 bg-green-50/80 dark:bg-green-900/20 rounded-xl border border-green-200/50 dark:border-green-800/30">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                    <span class="text-sm font-semibold text-green-700 dark:text-green-300">{{ __('app.authentic_product') }}</span>
                                </div>

                                <!-- Long-lasting -->
                                <div class="flex items-center gap-3 p-4 bg-blue-50/80 dark:bg-blue-900/20 rounded-xl border border-blue-200/50 dark:border-blue-800/30">
                                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-sm font-semibold text-blue-700 dark:text-blue-300">{{ __('app.long_lasting') }}</span>
                                </div>

                                <!-- Premium Quality -->
                                <div class="flex items-center gap-3 p-4 bg-purple-50/80 dark:bg-purple-900/20 rounded-xl border border-purple-200/50 dark:border-purple-800/30">
                                    <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                    </svg>
                                    <span class="text-sm font-semibold text-purple-700 dark:text-purple-300">{{ __('app.premium_quality') }}</span>
                                </div>

                                <!-- Fast Delivery -->
                                <div class="flex items-center gap-3 p-4 bg-amber-50/80 dark:bg-amber-900/20 rounded-xl border border-amber-200/50 dark:border-amber-800/30">
                                    <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    <span class="text-sm font-semibold text-amber-700 dark:text-amber-300">{{ __('app.fast_delivery') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Technical Specifications Panel -->
                    <div class="lg:col-span-1 space-y-6">
                        <!-- Fragrance Profile -->
                        <div class="backdrop-blur-sm bg-gradient-to-br from-slate-50/80 to-white/80 dark:from-slate-800/80 dark:to-slate-900/80 rounded-xl p-6 border border-slate-200/50 dark:border-slate-700/50">
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-200 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-rose-600 dark:text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                {{ __('app.fragrance_profile') }}
                            </h3>
                            
                            <!-- Fragrance Notes (Mock Data) -->
                            <div class="space-y-4">
                                <div>
                                    <h4 class="text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">{{ __('app.top_notes') }}</h4>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="px-3 py-1 bg-rose-100 dark:bg-rose-900/30 text-rose-700 dark:text-rose-300 rounded-full text-xs font-medium">Citrus</span>
                                        <span class="px-3 py-1 bg-rose-100 dark:bg-rose-900/30 text-rose-700 dark:text-rose-300 rounded-full text-xs font-medium">Bergamot</span>
                                    </div>
                                </div>
                                
                                <div>
                                    <h4 class="text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">{{ __('app.heart_notes') }}</h4>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="px-3 py-1 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 rounded-full text-xs font-medium">Rose</span>
                                        <span class="px-3 py-1 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 rounded-full text-xs font-medium">Jasmine</span>
                                    </div>
                                </div>
                                
                                <div>
                                    <h4 class="text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">{{ __('app.base_notes') }}</h4>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="px-3 py-1 bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 rounded-full text-xs font-medium">Musk</span>
                                        <span class="px-3 py-1 bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 rounded-full text-xs font-medium">Sandalwood</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Performance Metrics -->
                        <div class="backdrop-blur-sm bg-gradient-to-br from-slate-50/80 to-white/80 dark:from-slate-800/80 dark:to-slate-900/80 rounded-xl p-6 border border-slate-200/50 dark:border-slate-700/50">
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-200 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                {{ __('app.performance') }}
                            </h3>
                            
                            <div class="space-y-4">
                                <!-- Longevity -->
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-slate-600 dark:text-slate-400">{{ __('app.longevity') }}</span>
                                    <div class="flex items-center gap-2">
                                        <div class="flex">
                                            @for($i = 1; $i <= 5; $i++)
                                                <div class="w-2 h-2 rounded-full mr-1 {{ $i <= 4 ? 'bg-green-500' : 'bg-slate-300 dark:bg-slate-600' }}"></div>
                                            @endfor
                                        </div>
                                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">8+ hrs</span>
                                    </div>
                                </div>

                                <!-- Sillage -->
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-slate-600 dark:text-slate-400">{{ __('app.sillage') }}</span>
                                    <div class="flex items-center gap-2">
                                        <div class="flex">
                                            @for($i = 1; $i <= 5; $i++)
                                                <div class="w-2 h-2 rounded-full mr-1 {{ $i <= 3 ? 'bg-blue-500' : 'bg-slate-300 dark:bg-slate-600' }}"></div>
                                            @endfor
                                        </div>
                                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">{{ __('app.moderate') }}</span>
                                    </div>
                                </div>

                                <!-- Projection -->
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-slate-600 dark:text-slate-400">{{ __('app.projection') }}</span>
                                    <div class="flex items-center gap-2">
                                        <div class="flex">
                                            @for($i = 1; $i <= 5; $i++)
                                                <div class="w-2 h-2 rounded-full mr-1 {{ $i <= 4 ? 'bg-purple-500' : 'bg-slate-300 dark:bg-slate-600' }}"></div>
                                            @endfor
                                        </div>
                                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">{{ __('app.good') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Season Recommendations -->
                        <div class="backdrop-blur-sm bg-gradient-to-br from-slate-50/80 to-white/80 dark:from-slate-800/80 dark:to-slate-900/80 rounded-xl p-6 border border-slate-200/50 dark:border-slate-700/50">
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-200 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                                </svg>
                                {{ __('app.best_seasons') }}
                            </h3>
                            
                            <div class="grid grid-cols-2 gap-2">
                                <div class="flex items-center gap-2 p-2 bg-green-100 dark:bg-green-900/30 rounded-lg">
                                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                    <span class="text-xs font-medium text-green-700 dark:text-green-300">{{ __('app.spring') }}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-amber-100 dark:bg-amber-900/30 rounded-lg">
                                    <div class="w-2 h-2 bg-amber-500 rounded-full"></div>
                                    <span class="text-xs font-medium text-amber-700 dark:text-amber-300">{{ __('app.summer') }}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-slate-100 dark:bg-slate-700 rounded-lg opacity-50">
                                    <div class="w-2 h-2 bg-slate-400 rounded-full"></div>
                                    <span class="text-xs font-medium text-slate-600 dark:text-slate-400">{{ __('app.autumn') }}</span>
                                </div>
                                <div class="flex items-center gap-2 p-2 bg-slate-100 dark:bg-slate-700 rounded-lg opacity-50">
                                    <div class="w-2 h-2 bg-slate-400 rounded-full"></div>
                                    <span class="text-xs font-medium text-slate-600 dark:text-slate-400">{{ __('app.winter') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <div class="backdrop-blur-sm bg-white/30 dark:bg-white/10 rounded-2xl p-8 shadow-lg border border-white/40 dark:border-white/20">
                <h2 class="text-2xl font-semibold text-slate-900 dark:text-slate-200 mb-8">{{ __('app.related_products') }}</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $relatedProduct)
                        <div class="backdrop-blur-sm bg-white/30 dark:bg-white/10 rounded-2xl overflow-hidden shadow-lg border border-white/40 dark:border-white/20 hover:shadow-2xl hover:bg-white/40 dark:hover:bg-white/15 transition-all duration-300 h-full flex flex-col group">
                            <div class="aspect-square overflow-hidden">
                                <img src="{{ $relatedProduct->main_image_url }}" 
                                     alt="{{ $relatedProduct->name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                            
                            <div class="p-4 flex-grow flex flex-col">
                                <div class="mb-2 h-[1.8rem] flex items-center">
                                    <span class="inline-block px-2 py-1 text-xs bg-brand-100 dark:bg-brand-900/30 text-brand-700 dark:text-brand-300 rounded-full font-medium">
                                        {{ $relatedProduct->category->name }}
                                    </span>
                                </div>
                                
                                <h3 class="font-semibold text-slate-900 dark:text-slate-100 mb-2 line-clamp-2 text-sm h-[2.5rem] flex items-start">
                                    {{ $relatedProduct->name }}
                                </h3>
                                
                                <div class="mb-2 h-[1.2rem] flex items-center">
                                    @if($relatedProduct->brand)
                                        <p class="text-xs text-slate-600 dark:text-slate-400">{{ $relatedProduct->brand }}</p>
                                    @endif
                                </div>
                                
                                <div class="flex items-center justify-between mb-3 h-[1.2rem]">
                                    <div class="text-xs text-slate-500 dark:text-slate-400">
                                        {{ $relatedProduct->volume_ml }}ml
                                    </div>
                                    <div class="text-xs text-slate-500 dark:text-slate-400">
                                        @switch($relatedProduct->gender)
                                            @case('male') Nam @break
                                            @case('female') Nữ @break
                                            @default Unisex
                                        @endswitch
                                    </div>
                                </div>
                                
                                <div class="mb-4 min-h-[3rem] flex items-start">
                                    @if($relatedProduct->is_on_sale)
                                        <div class="flex flex-col gap-1">
                                            <span class="text-lg font-bold text-brand-600">
                                                {{ number_format($relatedProduct->final_price, 0, ',', '.') }}đ
                                            </span>
                                            <span class="text-sm text-slate-400 line-through">
                                                {{ number_format($relatedProduct->price, 0, ',', '.') }}đ
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-lg font-bold text-slate-900 dark:text-slate-100">
                                            {{ number_format($relatedProduct->price, 0, ',', '.') }}đ
                                        </span>
                                    @endif
                                </div>
                                
                                <a href="{{ route('products.show', $relatedProduct) }}" 
                                   class="group/btn relative w-full inline-flex items-center justify-center gap-2 px-3 py-2.5 bg-white/90 dark:bg-white/80 text-slate-800 dark:text-slate-900 rounded-xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl border border-slate-200/50 dark:border-slate-300/50 hover:bg-white dark:hover:bg-white overflow-hidden whitespace-nowrap text-sm mt-auto">
                                    <!-- Shimmer effect -->
                                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent transform -skew-x-12 -translate-x-full group-hover/btn:translate-x-full transition-transform duration-700"></div>
                                    
                                    <svg class="w-3.5 h-3.5 group-hover/btn:scale-110 transition-transform duration-300 relative z-10 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <span class="relative z-10 flex-shrink-0">{{ __('app.view_details') }}</span>
                                    <svg class="w-2.5 h-2.5 group-hover/btn:translate-x-1 transition-transform duration-300 relative z-10 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

<script>
// Enhanced gallery management with new features
const galleryImages = [
    @if($product->main_image)
        '{{ $product->main_image_url }}',
    @endif
    @if($product->has_gallery && $product->images->count() > 0)
        @foreach($product->images as $image)
            '{{ $image->image_url }}',
        @endforeach
    @endif
];
let currentIndex = 0;
let isZoomed = false;
const productPrice = {{ $product->final_price }};
const isEnglish = {{ app()->getLocale() === 'en' ? 'true' : 'false' }};

// Enhanced quantity management with total price calculation
function changeQuantity(change) {
    const input = document.getElementById('quantity');
    const currentValue = parseInt(input.value) || 1;
    const newValue = Math.max(1, Math.min(currentValue + change, {{ $product->stock }}));
    input.value = newValue;
    updateTotalPrice(newValue);
}

function updateTotalPrice(quantity) {
    const totalPriceElement = document.getElementById('total-price');
    if (totalPriceElement) {
        const total = productPrice * quantity;
        if (isEnglish) {
            totalPriceElement.textContent = '$' + (total / 25000).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
        } else {
            totalPriceElement.textContent = total.toLocaleString('vi-VN') + 'đ';
        }
    }
}

// Enhanced image gallery management
function changeMainImage(imageUrl, button, index) {
    // Show loading skeleton briefly
    const skeleton = document.getElementById('image-skeleton');
    const mainImage = document.getElementById('main-product-image');
    
    if (skeleton && mainImage) {
        skeleton.classList.remove('hidden');
        mainImage.style.opacity = '0.5';
        
        setTimeout(() => {
            mainImage.src = imageUrl;
            mainImage.onload = () => {
                skeleton.classList.add('hidden');
                mainImage.style.opacity = '1';
            };
        }, 200);
    } else {
        mainImage.src = imageUrl;
    }
    
    currentIndex = index;
    updateImageCounter(index + 1);
    updateProgressDots(index);
    updateThumbnailStates(button);
}

function updateImageCounter(current) {
    const counter = document.getElementById('current-image-number');
    if (counter) {
        counter.textContent = current;
    }
}

function updateProgressDots(activeIndex) {
    const dots = document.querySelectorAll('.progress-dot');
    dots.forEach((dot, index) => {
        if (index === activeIndex) {
            dot.classList.remove('bg-white/50');
            dot.classList.add('bg-white', 'scale-125');
        } else {
            dot.classList.remove('bg-white', 'scale-125');
            dot.classList.add('bg-white/50');
        }
    });
}

function updateThumbnailStates(activeButton) {
    document.querySelectorAll('#thumbnails button').forEach(btn => {
        if (btn.classList.contains('main-image-thumb')) {
            if (btn === activeButton) {
                btn.classList.remove('border-brand-500', 'dark:border-brand-400');
                btn.classList.add('border-brand-600', 'dark:border-brand-300');
            } else {
                btn.classList.remove('border-brand-600', 'dark:border-brand-300');
                btn.classList.add('border-brand-500', 'dark:border-brand-400');
            }
        } else {
            btn.classList.remove('border-brand-500', 'dark:border-brand-400');
            btn.classList.add('border-slate-200', 'dark:border-slate-700');
        }
    });
    
    if (!activeButton.classList.contains('main-image-thumb')) {
        activeButton.classList.remove('border-slate-200', 'dark:border-slate-700');
        activeButton.classList.add('border-brand-500', 'dark:border-brand-400');
    }
}

function galleryShow(index) {
    if (!galleryImages || galleryImages.length === 0) return;
    
    currentIndex = (index + galleryImages.length) % galleryImages.length;
    const url = galleryImages[currentIndex];
    const mainImage = document.getElementById('main-product-image');
    
    if (mainImage) {
        const skeleton = document.getElementById('image-skeleton');
        if (skeleton) {
            skeleton.classList.remove('hidden');
            mainImage.style.opacity = '0.5';
            
            setTimeout(() => {
                mainImage.src = url;
                mainImage.onload = () => {
                    skeleton.classList.add('hidden');
                    mainImage.style.opacity = '1';
                };
            }, 200);
        } else {
            mainImage.src = url;
        }
    }
    
    updateImageCounter(currentIndex + 1);
    updateProgressDots(currentIndex);
    
    // Update thumbnail states
    const thumbnails = document.querySelectorAll('#thumbnails button');
    if (thumbnails.length > currentIndex) {
        updateThumbnailStates(thumbnails[currentIndex]);
    }
}

function galleryPrev() { 
    galleryShow(currentIndex - 1); 
}

function galleryNext() { 
    galleryShow(currentIndex + 1); 
}

// New zoom functionality
function toggleZoom() {
    const mainImage = document.getElementById('main-product-image');
    if (!mainImage) return;
    
    isZoomed = !isZoomed;
    
    if (isZoomed) {
        mainImage.style.transform = 'scale(1.5)';
        mainImage.style.cursor = 'zoom-out';
        mainImage.parentElement.style.overflow = 'auto';
    } else {
        mainImage.style.transform = 'scale(1)';
        mainImage.style.cursor = 'zoom-in';
        mainImage.parentElement.style.overflow = 'hidden';
    }
}

// Enhanced keyboard navigation
document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowLeft') {
        e.preventDefault();
        galleryPrev();
    }
    if (e.key === 'ArrowRight') {
        e.preventDefault();
        galleryNext();
    }
    if (e.key === 'Escape' && isZoomed) {
        toggleZoom();
    }
    if (e.key === ' ') {
        e.preventDefault();
        toggleZoom();
    }
});

// Touch/swipe support for mobile
let touchStartX = 0;
let touchEndX = 0;

document.addEventListener('touchstart', (e) => {
    touchStartX = e.changedTouches[0].screenX;
});

document.addEventListener('touchend', (e) => {
    touchEndX = e.changedTouches[0].screenX;
    handleSwipe();
});

function handleSwipe() {
    const swipeThreshold = 50;
    const diff = touchStartX - touchEndX;
    
    if (Math.abs(diff) > swipeThreshold) {
        if (diff > 0) {
            galleryNext(); // Swipe left = next image
        } else {
            galleryPrev(); // Swipe right = previous image
        }
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    // Set initial total price
    const quantity = parseInt(document.getElementById('quantity')?.value) || 1;
    updateTotalPrice(quantity);
    
    // Initialize progress dots
    updateProgressDots(0);
    
    // Add quantity input listener
    const quantityInput = document.getElementById('quantity');
    if (quantityInput) {
        quantityInput.addEventListener('input', (e) => {
            const value = parseInt(e.target.value) || 1;
            updateTotalPrice(value);
        });
    }
});
</script>
@endsection
