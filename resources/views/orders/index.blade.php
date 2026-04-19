@extends('layouts.app')
@section('title', 'Pesanan Saya - Sofia Snack')

@section('content')
    <section class="bg-gradient-to-r from-primary to-primary-dark py-10">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-3xl font-bold text-white">Pesanan Saya</h1>
            <p class="text-secondary-light mt-2">Riwayat dan status pesanan Anda</p>
        </div>
    </section>

    <div class="max-w-4xl mx-auto px-4 py-8">
        @if($orders->isNotEmpty())
            <div class="space-y-4">
                @foreach($orders as $order)
                    <a href="{{ route('orders.show', $order) }}" class="block bg-white rounded-2xl shadow-sm border border-brown-border/30 hover:shadow-md transition-all duration-300 hover:-translate-y-0.5 overflow-hidden">
                        <div class="p-5 sm:p-6">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-cream-dark rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-brown-text">Pesanan #{{ $order->id }}</p>
                                        <p class="text-xs text-brown-muted">{{ $order->created_at->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>
                                @php
                                    $statusConfig = [
                                        'pending' => ['bg-yellow-100 text-yellow-700', 'Menunggu'],
                                        'processing' => ['bg-blue-100 text-blue-700', 'Diproses'],
                                        'completed' => ['bg-green-100 text-green-700', 'Selesai'],
                                        'cancelled' => ['bg-red-100 text-red-700', 'Dibatalkan'],
                                    ];
                                    $sc = $statusConfig[$order->status] ?? ['bg-gray-100 text-gray-700', ucfirst($order->status)];
                                @endphp
                                <span class="text-xs px-3 py-1.5 rounded-full font-semibold {{ $sc[0] }} w-fit">{{ $sc[1] }}</span>
                            </div>

                            {{-- Item preview --}}
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($order->items->take(3) as $item)
                                    <span class="text-xs bg-cream px-2.5 py-1 rounded-lg text-brown-text font-medium">{{ $item->product_name }} x{{ $item->quantity }}</span>
                                @endforeach
                                @if($order->items->count() > 3)
                                    <span class="text-xs bg-cream px-2.5 py-1 rounded-lg text-brown-muted">+{{ $order->items->count() - 3 }} lainnya</span>
                                @endif
                            </div>

                            <div class="flex items-center justify-between pt-3 border-t border-brown-border/20">
                                <span class="text-sm text-brown-muted">{{ $order->items->sum('quantity') }} item</span>
                                <span class="font-bold text-primary text-lg">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <svg class="w-24 h-24 mx-auto mb-6 text-brown-border" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
                <h2 class="text-2xl font-bold text-brown-text mb-2">Belum Ada Pesanan</h2>
                <p class="text-brown-muted mb-6">Anda belum memiliki riwayat pesanan.</p>
                <a href="{{ route('products.index') }}" class="bg-primary text-white px-8 py-3 rounded-xl hover:bg-primary-dark transition-colors font-semibold">Mulai Belanja</a>
            </div>
        @endif
    </div>
@endsection
