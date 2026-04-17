@extends('admin.layouts.app')
@section('title', 'Kelola Pesanan')
@section('page-title', 'Pesanan')

@section('content')
    <div class="mb-6">
        <p class="text-brown-muted text-sm">Kelola semua pesanan pelanggan</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-brown-border/30 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-cream">
                    <tr>
                        <th class="text-left py-3 px-6 text-xs font-semibold text-brown-muted uppercase tracking-wider">ID</th>
                        <th class="text-left py-3 px-4 text-xs font-semibold text-brown-muted uppercase tracking-wider">Pelanggan</th>
                        <th class="text-left py-3 px-4 text-xs font-semibold text-brown-muted uppercase tracking-wider">Telepon</th>
                        <th class="text-right py-3 px-4 text-xs font-semibold text-brown-muted uppercase tracking-wider">Total</th>
                        <th class="text-center py-3 px-4 text-xs font-semibold text-brown-muted uppercase tracking-wider">Status</th>
                        <th class="text-left py-3 px-4 text-xs font-semibold text-brown-muted uppercase tracking-wider">Tanggal</th>
                        <th class="text-center py-3 px-4 text-xs font-semibold text-brown-muted uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brown-border/20">
                    @forelse($orders as $order)
                        <tr class="hover:bg-cream/50 transition-colors">
                            <td class="py-3 px-6 text-sm font-medium text-brown-text">#{{ $order->id }}</td>
                            <td class="py-3 px-4 text-sm text-brown-text">{{ $order->customer_name }}</td>
                            <td class="py-3 px-4 text-sm text-brown-muted">{{ $order->customer_phone }}</td>
                            <td class="py-3 px-4 text-sm font-medium text-primary text-right">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="py-3 px-4 text-center">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        'processing' => 'bg-blue-100 text-blue-700',
                                        'completed' => 'bg-green-100 text-green-700',
                                        'cancelled' => 'bg-red-100 text-red-700',
                                    ];
                                @endphp
                                <span class="text-xs px-2.5 py-1 rounded-full font-medium {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700' }}">{{ ucfirst($order->status) }}</span>
                            </td>
                            <td class="py-3 px-4 text-sm text-brown-muted">{{ $order->created_at->format('d M Y H:i') }}</td>
                            <td class="py-3 px-4 text-center">
                                <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-500 hover:text-blue-700 transition-colors p-1" title="Lihat Detail">
                                    <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-brown-muted text-sm">Belum ada pesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($orders->hasPages())
            <div class="px-6 py-4 border-t border-brown-border/30">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
@endsection
