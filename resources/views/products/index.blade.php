@extends('layouts.app')
@section('title', 'Produk - Sofia Snack')

@section('content')
    {{-- Page Header --}}
    <section class="bg-gradient-to-r from-primary to-primary-dark py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl font-bold text-white mb-2">Produk Kami</h1>
            <p class="text-secondary-light">Temukan kue dan snack favorit Anda</p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Filters --}}
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-brown-border/30 mb-8">
            <form method="GET" action="{{ route('products.index') }}" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
                        class="w-full px-4 py-2.5 rounded-xl border border-brown-border bg-cream focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors text-sm">
                </div>
                <div>
                    <select name="category" class="w-full sm:w-48 px-4 py-2.5 rounded-xl border border-brown-border bg-cream focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors text-sm">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-primary text-white px-6 py-2.5 rounded-xl hover:bg-primary-dark transition-colors font-medium text-sm">
                    Filter
                </button>
                @if(request('search') || request('category'))
                    <a href="{{ route('products.index') }}" class="text-brown-muted hover:text-primary px-4 py-2.5 text-sm font-medium transition-colors">Reset</a>
                @endif
            </form>
        </div>

        {{-- Products Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($products as $product)
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg border border-brown-border/30 transition-all duration-300 group hover:-translate-y-1">
                    <div class="relative h-52 bg-brown-light overflow-hidden">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-brown-border" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                        @if($product->stock <= 0)
                            <div class="absolute top-3 right-3 bg-red-500 text-white text-xs px-3 py-1 rounded-full font-medium">Habis</div>
                        @endif
                    </div>
                    <div class="p-5">
                        <span class="text-xs text-secondary font-medium bg-secondary/10 px-2.5 py-0.5 rounded-full">{{ $product->category->name ?? '-' }}</span>
                        <h3 class="font-semibold text-brown-text mt-2 mb-1 text-lg">
                            <a href="{{ route('products.show', $product->slug) }}" class="hover:text-primary transition-colors">{{ $product->name }}</a>
                        </h3>
                        <p class="text-brown-muted text-sm line-clamp-2 mb-3">{{ Str::limit($product->description, 80) }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-primary font-bold text-xl">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            @if($product->stock > 0)
                                <form method="POST" action="{{ route('cart.add', $product) }}">
                                    @csrf
                                    <button type="submit" class="bg-primary text-white px-4 py-2 rounded-xl hover:bg-primary-dark transition-colors text-sm font-medium flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                        Keranjang
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16 text-brown-muted">
                    <svg class="w-20 h-20 mx-auto mb-4 text-brown-border" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    <p class="text-xl font-medium mb-2">Produk tidak ditemukan</p>
                    <p>Coba gunakan kata kunci atau filter yang berbeda.</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $products->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
