@extends('layouts.app')
@section('title', 'Detail Pesanan #' . $order->id . ' - Sofia Snack')

@section('content')
    <section class="bg-gradient-to-r from-primary to-primary-dark py-10">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-3xl font-bold text-white">Detail Pesanan</h1>
        </div>
    </section>

    <div class="max-w-4xl mx-auto px-4 py-8">
        <a href="{{ route('orders.index') }}" class="inline-flex items-center gap-1 text-sm text-brown-muted hover:text-primary transition-colors mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Pesanan Saya
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Order Items --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-brown-border/30 overflow-hidden">
                    <div class="px-6 py-4 border-b border-brown-border/30 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-brown-text">Pesanan #{{ $order->id }}</h3>
                        @php
                            $statusConfig = [
                                'pending' => ['bg-yellow-100 text-yellow-700', 'Menunggu'],
                                'processing' => ['bg-blue-100 text-blue-700', 'Diproses'],
                                'completed' => ['bg-green-100 text-green-700', 'Selesai'],
                                'cancelled' => ['bg-red-100 text-red-700', 'Dibatalkan'],
                            ];
                            $sc = $statusConfig[$order->status] ?? ['bg-gray-100 text-gray-700', ucfirst($order->status)];
                        @endphp
                        <span class="text-xs px-3 py-1.5 rounded-full font-semibold {{ $sc[0] }}">{{ $sc[1] }}</span>
                    </div>

                    <div class="divide-y divide-brown-border/20">
                        @foreach($order->items as $item)
                            <div class="flex items-center gap-4 p-5">
                                <div class="w-16 h-16 bg-brown-light rounded-xl overflow-hidden flex-shrink-0">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-6 h-6 text-brown-border" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-medium text-brown-text text-sm">{{ $item->product_name }}</h4>
                                    <p class="text-xs text-brown-muted mt-0.5">{{ $item->quantity }}x @ Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>
                                <span class="font-semibold text-primary text-sm whitespace-nowrap">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="bg-cream-dark px-6 py-4 flex justify-between items-center">
                        <span class="font-semibold text-brown-text">Total</span>
                        <span class="text-xl font-bold text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- Order Info Sidebar --}}
            <div class="space-y-6">
                {{-- Status Timeline --}}
                <div class="bg-white rounded-2xl shadow-sm border border-brown-border/30 p-6">
                    <h3 class="text-lg font-semibold text-brown-text mb-4">Status Pesanan</h3>
                    @php
                        $steps = ['pending' => 'Menunggu', 'processing' => 'Diproses', 'completed' => 'Selesai'];
                        $currentIndex = array_search($order->status, array_keys($steps));
                        if ($order->status === 'cancelled') $currentIndex = -1;
                    @endphp

                    @if($order->status === 'cancelled')
                        <div class="flex items-center gap-3 p-3 bg-red-50 rounded-xl">
                            <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </div>
                            <span class="text-sm font-medium text-red-700">Pesanan Dibatalkan</span>
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach($steps as $key => $label)
                                @php
                                    $stepIndex = array_search($key, array_keys($steps));
                                    $isDone = $stepIndex <= $currentIndex;
                                    $isCurrent = $stepIndex === $currentIndex;
                                @endphp
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $isDone ? 'bg-green-100' : 'bg-gray-100' }}">
                                        @if($isDone)
                                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        @else
                                            <div class="w-2.5 h-2.5 rounded-full bg-gray-300"></div>
                                        @endif
                                    </div>
                                    <span class="text-sm {{ $isCurrent ? 'font-semibold text-brown-text' : ($isDone ? 'text-green-700 font-medium'  : 'text-brown-muted') }}">{{ $label }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Customer Info --}}
                <div class="bg-white rounded-2xl shadow-sm border border-brown-border/30 p-6">
                    <h3 class="text-lg font-semibold text-brown-text mb-4">Informasi Pengiriman</h3>
                    <div class="space-y-3 text-sm">
                        <div>
                            <p class="text-brown-muted text-xs">Nama</p>
                            <p class="font-medium text-brown-text">{{ $order->customer_name }}</p>
                        </div>
                        <div>
                            <p class="text-brown-muted text-xs">Telepon</p>
                            <p class="font-medium text-brown-text">{{ $order->customer_phone }}</p>
                        </div>
                        <div>
                            <p class="text-brown-muted text-xs">Alamat</p>
                            <p class="font-medium text-brown-text">{{ $order->customer_address }}</p>
                        </div>
                        @if($order->notes)
                            <div>
                                <p class="text-brown-muted text-xs">Catatan</p>
                                <p class="font-medium text-brown-text">{{ $order->notes }}</p>
                            </div>
                        @endif
                        <div class="pt-3 border-t border-brown-border/30">
                            <p class="text-brown-muted text-xs">Tanggal Pesanan</p>
                            <p class="font-medium text-brown-text">{{ $order->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
