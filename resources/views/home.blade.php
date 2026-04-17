@extends('layouts.app')
@section('title', 'Sofia Snack - Toko Kue & Snack Terbaik')

@section('content')
    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-br from-primary via-primary-dark to-primary overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-72 h-72 bg-secondary rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-96 h-96 bg-accent rounded-full blur-3xl"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32 relative z-10">
            <div class="text-center">
                <span class="inline-block bg-secondary/20 text-secondary-light px-4 py-1.5 rounded-full text-sm font-medium mb-6 tracking-wide">🍰 Selamat Datang di Sofia Snack</span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                    Kue & Snack Lezat<br>
                    <span class="text-secondary">Untuk Setiap Momen</span>
                </h1>
                <p class="text-lg text-secondary-light max-w-2xl mx-auto mb-10 leading-relaxed">
                    Nikmati berbagai pilihan kue basah, kue kering, roti, dan pastry berkualitas tinggi yang dibuat dengan bahan terbaik dan penuh cinta.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('products.index') }}" class="bg-secondary text-primary-dark px-8 py-3.5 rounded-xl font-semibold hover:bg-secondary-light transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Lihat Produk
                    </a>
                    <a href="{{ route('cart.index') }}" class="border-2 border-secondary/50 text-white px-8 py-3.5 rounded-xl font-semibold hover:bg-secondary/10 transition-all duration-300">
                        Keranjang Belanja
                    </a>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 100L60 88C120 75 240 50 360 42C480 33 600 42 720 50C840 58 960 67 1080 63C1200 58 1320 42 1380 33L1440 25V100H0Z" fill="#FFF9F0"/>
            </svg>
        </div>
    </section>

    {{-- Categories Section --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-primary mb-3">Kategori Produk</h2>
            <p class="text-brown-muted max-w-lg mx-auto">Jelajahi berbagai kategori kue dan snack favorit kami</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            @forelse($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="group bg-white rounded-2xl p-6 text-center shadow-sm hover:shadow-lg border border-brown-border/50 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-16 h-16 bg-cream-dark rounded-2xl flex items-center justify-center mx-auto mb-3 group-hover:bg-secondary/20 transition-colors">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0A1.75 1.75 0 013 15.546V12a9 9 0 0118 0v3.546zM12 3v2m-4.243.757L6.343 7.17m9.9-1.413L17.657 7.17"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-brown-text text-sm">{{ $category->name }}</h3>
                    <p class="text-xs text-brown-muted mt-1">{{ $category->products_count }} produk</p>
                </a>
            @empty
                <div class="col-span-full text-center py-8 text-brown-muted">
                    <p>Belum ada kategori tersedia.</p>
                </div>
            @endforelse
        </div>
    </section>

    {{-- Featured Products --}}
    <section class="bg-cream-dark py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-12">
                <div>
                    <h2 class="text-3xl font-bold text-primary mb-2">Produk Terbaru</h2>
                    <p class="text-brown-muted">Pilihan kue dan snack terbaru dari kami</p>
                </div>
                <a href="{{ route('products.index') }}" class="hidden sm:inline-flex items-center gap-2 text-primary hover:text-primary-dark font-medium transition-colors">
                    Lihat Semua
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($featuredProducts as $product)
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg border border-brown-border/30 transition-all duration-300 group hover:-translate-y-1">
                        <div class="relative h-48 bg-brown-light overflow-hidden">
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
                                <div class="absolute top-3 right-3 bg-red-500 text-white text-xs px-2 py-1 rounded-full font-medium">Habis</div>
                            @endif
                        </div>
                        <div class="p-4">
                            <span class="text-xs text-secondary font-medium bg-secondary/10 px-2 py-0.5 rounded-full">{{ $product->category->name ?? '-' }}</span>
                            <h3 class="font-semibold text-brown-text mt-2 mb-1">
                                <a href="{{ route('products.show', $product->slug) }}" class="hover:text-primary transition-colors">{{ $product->name }}</a>
                            </h3>
                            <div class="flex items-center justify-between mt-3">
                                <span class="text-primary font-bold text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                @if($product->stock > 0)
                                    <form method="POST" action="{{ route('cart.add', $product) }}">
                                        @csrf
                                        <button type="submit" class="bg-primary text-white p-2 rounded-lg hover:bg-primary-dark transition-colors" title="Tambah ke keranjang">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-brown-muted">
                        <svg class="w-16 h-16 mx-auto mb-4 text-brown-border" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        <p class="text-lg font-medium mb-1">Belum ada produk</p>
                        <p class="text-sm">Produk akan segera tersedia.</p>
                    </div>
                @endforelse
            </div>
            <div class="text-center mt-8 sm:hidden">
                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-primary font-medium">
                    Lihat Semua Produk
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-gradient-to-r from-primary to-primary-dark rounded-3xl p-8 md:p-12 text-center text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-secondary/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-2xl"></div>
            <div class="relative z-10">
                <h2 class="text-2xl md:text-3xl font-bold mb-4">Pesan Kue Spesial Sekarang!</h2>
                <p class="text-secondary-light mb-8 max-w-xl mx-auto">Dapatkan kue-kue terbaik untuk acara spesial Anda. Tersedia untuk pemesanan dalam jumlah besar.</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-secondary text-primary-dark px-8 py-3 rounded-xl font-semibold hover:bg-secondary-light transition-all duration-300 shadow-lg">
                    Mulai Belanja
                </a>
            </div>
        </div>
    </section>
@endsection
