@extends('admin.layouts.app')
@section('title', 'Detail Pesanan #' . $order->id)
@section('page-title', 'Detail Pesanan #' . $order->id)

@section('content')
    <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-1 text-sm text-brown-muted hover:text-primary transition-colors mb-6">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Kembali
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Order Info --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Items --}}
            <div class="bg-white rounded-2xl shadow-sm border border-brown-border/30 overflow-hidden">
                <div class="px-6 py-4 border-b border-brown-border/30">
                    <h3 class="text-lg font-semibold text-brown-text">Item Pesanan</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-cream">
                            <tr>
                                <th class="text-left py-3 px-6 text-xs font-semibold text-brown-muted uppercase">Produk</th>
                                <th class="text-right py-3 px-4 text-xs font-semibold text-brown-muted uppercase">Harga</th>
                                <th class="text-center py-3 px-4 text-xs font-semibold text-brown-muted uppercase">Qty</th>
                                <th class="text-right py-3 px-6 text-xs font-semibold text-brown-muted uppercase">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-brown-border/20">
                            @foreach($order->items as $item)
                                <tr>
                                    <td class="py-3 px-6 text-sm text-brown-text font-medium">{{ $item->product_name }}</td>
                                    <td class="py-3 px-4 text-sm text-brown-muted text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="py-3 px-4 text-sm text-brown-text text-center">{{ $item->quantity }}</td>
                                    <td class="py-3 px-6 text-sm font-medium text-primary text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-cream-dark">
                            <tr>
                                <td colspan="3" class="py-3 px-6 text-sm font-semibold text-brown-text text-right">Total</td>
                                <td class="py-3 px-6 text-lg font-bold text-primary text-right">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            {{-- Customer Info --}}
            <div class="bg-white rounded-2xl shadow-sm border border-brown-border/30 p-6">
                <h3 class="text-lg font-semibold text-brown-text mb-4">Informasi Pelanggan</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-brown-muted mb-1">Nama</p>
                        <p class="font-medium text-brown-text">{{ $order->customer_name }}</p>
                    </div>
                    <div>
                        <p class="text-brown-muted mb-1">Telepon</p>
                        <p class="font-medium text-brown-text">{{ $order->customer_phone }}</p>
                    </div>
                    <div class="sm:col-span-2">
                        <p class="text-brown-muted mb-1">Alamat</p>
                        <p class="font-medium text-brown-text">{{ $order->customer_address }}</p>
                    </div>
                    @if($order->notes)
                        <div class="sm:col-span-2">
                            <p class="text-brown-muted mb-1">Catatan</p>
                            <p class="font-medium text-brown-text">{{ $order->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Status Update --}}
        <div>
            <div class="bg-white rounded-2xl shadow-sm border border-brown-border/30 p-6 sticky top-24">
                <h3 class="text-lg font-semibold text-brown-text mb-4">Update Status</h3>

                @php
                    $statusColors = [
                        'pending' => 'bg-yellow-100 text-yellow-700',
                        'processing' => 'bg-blue-100 text-blue-700',
                        'completed' => 'bg-green-100 text-green-700',
                        'cancelled' => 'bg-red-100 text-red-700',
                    ];
                @endphp

                <div class="mb-4">
                    <p class="text-sm text-brown-muted mb-2">Status saat ini:</p>
                    <span class="text-sm px-3 py-1.5 rounded-full font-medium {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-700' }}">{{ ucfirst($order->status) }}</span>
                </div>

                <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}">
                    @csrf
                    @method('PATCH')
                    <div class="space-y-3">
                        <select name="status" class="w-full px-4 py-2.5 rounded-xl border border-brown-border bg-cream focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors text-sm">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <button type="submit" class="w-full bg-primary text-white py-2.5 rounded-xl hover:bg-primary-dark transition-colors font-medium text-sm">Update Status</button>
                    </div>
                </form>

                <div class="mt-6 pt-4 border-t border-brown-border/30 text-sm text-brown-muted">
                    <p>Dibuat: {{ $order->created_at->format('d M Y H:i') }}</p>
                    <p>Diperbarui: {{ $order->updated_at->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
