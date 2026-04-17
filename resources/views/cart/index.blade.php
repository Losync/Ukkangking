@extends('layouts.app')
@section('title', 'Keranjang Belanja - Sofia Snack')

@section('content')
    <section class="bg-gradient-to-r from-primary to-primary-dark py-10">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-3xl font-bold text-white">Keranjang Belanja</h1>
        </div>
    </section>

    <div class="max-w-4xl mx-auto px-4 py-8">
        @if(count($cart) > 0)
            <div class="bg-white rounded-2xl shadow-sm border border-brown-border/30 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-cream-dark">
                            <tr>
                                <th class="text-left py-4 px-6 text-sm font-semibold text-brown-text">Produk</th>
                                <th class="text-center py-4 px-4 text-sm font-semibold text-brown-text">Harga</th>
                                <th class="text-center py-4 px-4 text-sm font-semibold text-brown-text">Jumlah</th>
                                <th class="text-center py-4 px-4 text-sm font-semibold text-brown-text">Subtotal</th>
                                <th class="text-center py-4 px-4 text-sm font-semibold text-brown-text">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-brown-border/30">
                            @foreach($cart as $id => $item)
                                <tr>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-14 h-14 bg-brown-light rounded-xl overflow-hidden flex-shrink-0">
                                                @if($item['image'])
                                                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center">
                                                        <svg class="w-6 h-6 text-brown-border" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <span class="font-medium text-brown-text text-sm">{{ $item['name'] }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 text-center text-sm text-brown-muted">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                                    <td class="py-4 px-4">
                                        <form method="POST" action="{{ route('cart.update', $id) }}" class="flex items-center justify-center">
                                            @csrf
                                            @method('PATCH')
                                            <div class="flex items-center border border-brown-border rounded-lg overflow-hidden">
                                                <button type="submit" name="quantity" value="{{ max(1, $item['quantity'] - 1) }}" class="px-2.5 py-1 text-brown-muted hover:text-primary hover:bg-cream transition-colors text-sm">-</button>
                                                <span class="px-3 py-1 text-sm font-medium border-x border-brown-border">{{ $item['quantity'] }}</span>
                                                <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="px-2.5 py-1 text-brown-muted hover:text-primary hover:bg-cream transition-colors text-sm">+</button>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="py-4 px-4 text-center font-semibold text-primary text-sm">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                                    <td class="py-4 px-4 text-center">
                                        <form method="POST" action="{{ route('cart.remove', $id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-600 transition-colors" title="Hapus">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Total --}}
                <div class="bg-cream-dark px-6 py-5 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-lg">
                        <span class="text-brown-muted">Total: </span>
                        <span class="font-bold text-primary text-2xl">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('products.index') }}" class="border border-brown-border text-brown-text px-6 py-2.5 rounded-xl hover:bg-white transition-colors font-medium text-sm">Lanjut Belanja</a>
                        <a href="{{ route('checkout.index') }}" class="bg-primary text-white px-6 py-2.5 rounded-xl hover:bg-primary-dark transition-colors font-semibold text-sm">Checkout</a>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-16">
                <svg class="w-24 h-24 mx-auto mb-6 text-brown-border" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                <h2 class="text-2xl font-bold text-brown-text mb-2">Keranjang Kosong</h2>
                <p class="text-brown-muted mb-6">Belum ada produk di keranjang belanja Anda.</p>
                <a href="{{ route('products.index') }}" class="bg-primary text-white px-8 py-3 rounded-xl hover:bg-primary-dark transition-colors font-semibold">Mulai Belanja</a>
            </div>
        @endif
    </div>
@endsection
