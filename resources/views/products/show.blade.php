@extends('layouts.app')
@section('title', $product->name . ' - Sofia Snack')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-brown-muted mb-8">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Beranda</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('products.index') }}" class="hover:text-primary transition-colors">Produk</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-primary font-medium">{{ $product->name }}</span>
        </nav>

        {{-- Product Detail --}}
        <div class="bg-white rounded-2xl shadow-sm border border-brown-border/30 overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                {{-- Image --}}
                <div class="h-72 lg:h-auto bg-brown-light">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center min-h-80">
                            <svg class="w-24 h-24 text-brown-border" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                </div>

                {{-- Info --}}
                <div class="p-8 lg:p-10 flex flex-col justify-center">
                    <span class="inline-block text-sm text-secondary font-medium bg-secondary/10 px-3 py-1 rounded-full w-fit mb-4">{{ $product->category->name ?? '-' }}</span>
                    <h1 class="text-3xl font-bold text-brown-text mb-4">{{ $product->name }}</h1>
                    <p class="text-brown-muted leading-relaxed mb-6">{{ $product->description ?? 'Tidak ada deskripsi.' }}</p>

                    <div class="flex items-center gap-4 mb-6">
                        <span class="text-3xl font-bold text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex items-center gap-3 mb-8">
                        <span class="text-sm text-brown-muted">Stok:</span>
                        @if($product->stock > 0)
                            <span class="text-sm font-medium text-green-600 bg-green-50 px-3 py-1 rounded-full">Tersedia ({{ $product->stock }})</span>
                        @else
                            <span class="text-sm font-medium text-red-600 bg-red-50 px-3 py-1 rounded-full">Habis</span>
                        @endif
                    </div>

                    @if($product->stock > 0)
                        <form method="POST" action="{{ route('cart.add', $product) }}" class="flex items-center gap-4">
                            @csrf
                            <div class="flex items-center border border-brown-border rounded-xl overflow-hidden">
                                <button type="button" onclick="changeQty(-1)" class="px-4 py-3 text-brown-muted hover:text-primary hover:bg-cream transition-colors">-</button>
                                <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-16 text-center border-x border-brown-border py-3 focus:outline-none text-sm font-medium">
                                <button type="button" onclick="changeQty(1)" class="px-4 py-3 text-brown-muted hover:text-primary hover:bg-cream transition-colors">+</button>
                            </div>
                            <button type="submit" class="flex-1 bg-primary text-white py-3 rounded-xl hover:bg-primary-dark transition-colors font-semibold flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                                Tambah ke Keranjang
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        {{-- Related Products --}}
        @if($relatedProducts->isNotEmpty())
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-primary mb-6">Produk Serupa</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $related)
                        <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg border border-brown-border/30 transition-all duration-300 group hover:-translate-y-1">
                            <div class="relative h-44 bg-brown-light overflow-hidden">
                                @if($related->image)
                                    <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-12 h-12 text-brown-border" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-brown-text mb-1">
                                    <a href="{{ route('products.show', $related->slug) }}" class="hover:text-primary transition-colors">{{ $related->name }}</a>
                                </h3>
                                <span class="text-primary font-bold">Rp {{ number_format($related->price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    @push('scripts')
    <script>
        function changeQty(delta) {
            const input = document.getElementById('quantity');
            let val = parseInt(input.value) + delta;
            val = Math.max(1, Math.min(val, parseInt(input.max)));
            input.value = val;
        }
    </script>
    @endpush
@endsection
