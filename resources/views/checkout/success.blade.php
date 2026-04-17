@extends('layouts.app')
@section('title', 'Pesanan Berhasil - Sofia Snack')

@section('content')
    <div class="max-w-2xl mx-auto px-4 py-16 text-center">
        <div class="bg-white rounded-2xl shadow-sm border border-brown-border/30 p-8">
            <div class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-brown-text mb-3">Pesanan Berhasil!</h1>
            <p class="text-brown-muted mb-6">Terima kasih, pesanan Anda telah kami terima.</p>

            <div class="bg-cream rounded-xl p-6 text-left mb-6">
                <h3 class="font-semibold text-brown-text mb-3">Detail Pesanan #{{ $order->id }}</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between"><span class="text-brown-muted">Nama:</span><span class="font-medium">{{ $order->customer_name }}</span></div>
                    <div class="flex justify-between"><span class="text-brown-muted">Telepon:</span><span class="font-medium">{{ $order->customer_phone }}</span></div>
                    <div class="flex justify-between"><span class="text-brown-muted">Status:</span><span class="bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full text-xs font-medium">{{ ucfirst($order->status) }}</span></div>
                </div>

                <div class="border-t border-brown-border mt-4 pt-4 space-y-2">
                    @foreach($order->items as $item)
                        <div class="flex justify-between text-sm">
                            <span>{{ $item->product_name }} x{{ $item->quantity }}</span>
                            <span class="font-medium">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="border-t border-brown-border mt-4 pt-4 flex justify-between">
                    <span class="font-semibold text-brown-text">Total</span>
                    <span class="font-bold text-primary text-lg">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
            </div>

            <a href="{{ route('products.index') }}" class="inline-block bg-primary text-white px-8 py-3 rounded-xl hover:bg-primary-dark transition-colors font-semibold">Lanjut Belanja</a>
        </div>
    </div>
@endsection
