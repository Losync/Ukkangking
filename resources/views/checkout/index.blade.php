@extends('layouts.app')
@section('title', 'Checkout - Sofia Snack')

@section('content')
    <section class="bg-gradient-to-r from-primary to-primary-dark py-10">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-3xl font-bold text-white">Checkout</h1>
        </div>
    </section>

    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Form --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-brown-border/30 p-6">
                    <h2 class="text-xl font-bold text-brown-text mb-6">Data Pemesan</h2>
                    <form method="POST" action="{{ route('checkout.store') }}">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="customer_name" class="block text-sm font-medium text-brown-text mb-1">Nama Lengkap *</label>
                                <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name', auth()->user()->name ?? '') }}" required
                                    class="w-full px-4 py-2.5 rounded-xl border border-brown-border bg-cream focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors text-sm">
                                @error('customer_name')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label for="customer_phone" class="block text-sm font-medium text-brown-text mb-1">Nomor Telepon *</label>
                                <input type="text" name="customer_phone" id="customer_phone" value="{{ old('customer_phone') }}" required
                                    class="w-full px-4 py-2.5 rounded-xl border border-brown-border bg-cream focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors text-sm">
                                @error('customer_phone')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label for="customer_address" class="block text-sm font-medium text-brown-text mb-1">Alamat *</label>
                                <textarea name="customer_address" id="customer_address" rows="3" required
                                    class="w-full px-4 py-2.5 rounded-xl border border-brown-border bg-cream focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors text-sm resize-none">{{ old('customer_address') }}</textarea>
                                @error('customer_address')<span class="text-red-500 text-xs mt-1">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label for="notes" class="block text-sm font-medium text-brown-text mb-1">Catatan (Opsional)</label>
                                <textarea name="notes" id="notes" rows="2"
                                    class="w-full px-4 py-2.5 rounded-xl border border-brown-border bg-cream focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors text-sm resize-none">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-primary text-white py-3 rounded-xl hover:bg-primary-dark transition-colors font-semibold mt-6">
                            Buat Pesanan
                        </button>
                    </form>
                </div>
            </div>

            {{-- Order Summary --}}
            <div>
                <div class="bg-white rounded-2xl shadow-sm border border-brown-border/30 p-6 sticky top-24">
                    <h2 class="text-lg font-bold text-brown-text mb-4">Ringkasan Pesanan</h2>
                    <div class="space-y-3 mb-6">
                        @foreach($cart as $id => $item)
                            <div class="flex justify-between items-start text-sm">
                                <div>
                                    <p class="font-medium text-brown-text">{{ $item['name'] }}</p>
                                    <p class="text-brown-muted text-xs">{{ $item['quantity'] }}x Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                </div>
                                <span class="font-medium text-brown-text">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="border-t border-brown-border pt-4">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold text-brown-text">Total</span>
                            <span class="text-xl font-bold text-primary">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
