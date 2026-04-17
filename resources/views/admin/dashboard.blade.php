@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-brown-border/30">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-brown-text">{{ $totalProducts }}</p>
            <p class="text-sm text-brown-muted">Total Produk</p>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-brown-border/30">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-brown-text">{{ $totalCategories }}</p>
            <p class="text-sm text-brown-muted">Kategori</p>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-brown-border/30">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-brown-text">{{ $totalOrders }}</p>
            <p class="text-sm text-brown-muted">Total Pesanan</p>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-brown-border/30">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-brown-text">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            <p class="text-sm text-brown-muted">Pendapatan</p>
        </div>
    </div>

    {{-- Quick Actions & Recent Orders --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Quick Actions --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-brown-border/30">
            <h3 class="text-lg font-semibold text-brown-text mb-4">Aksi Cepat</h3>
            <div class="space-y-3">
                <a href="{{ route('admin.products.create') }}" class="flex items-center gap-3 p-3 rounded-xl bg-cream hover:bg-cream-dark transition-colors">
                    <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-brown-text">Tambah Produk</p>
                        <p class="text-xs text-brown-muted">Buat produk kue baru</p>
                    </div>
                </a>
                <a href="{{ route('admin.categories.create') }}" class="flex items-center gap-3 p-3 rounded-xl bg-cream hover:bg-cream-dark transition-colors">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-brown-text">Tambah Kategori</p>
                        <p class="text-xs text-brown-muted">Buat kategori baru</p>
                    </div>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 p-3 rounded-xl bg-cream hover:bg-cream-dark transition-colors">
                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-brown-text">Pesanan Pending</p>
                        <p class="text-xs text-brown-muted">{{ $pendingOrders }} pesanan menunggu</p>
                    </div>
                </a>
            </div>
        </div>

        {{-- Recent Orders --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-brown-border/30 overflow-hidden">
            <div class="px-6 py-4 border-b border-brown-border/30 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-brown-text">Pesanan Terbaru</h3>
                <a href="{{ route('admin.orders.index') }}" class="text-sm text-primary hover:text-primary-dark font-medium transition-colors">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-cream">
                        <tr>
                            <th class="text-left py-3 px-6 text-xs font-semibold text-brown-muted uppercase tracking-wider">ID</th>
                            <th class="text-left py-3 px-4 text-xs font-semibold text-brown-muted uppercase tracking-wider">Pelanggan</th>
                            <th class="text-left py-3 px-4 text-xs font-semibold text-brown-muted uppercase tracking-wider">Total</th>
                            <th class="text-left py-3 px-4 text-xs font-semibold text-brown-muted uppercase tracking-wider">Status</th>
                            <th class="text-left py-3 px-4 text-xs font-semibold text-brown-muted uppercase tracking-wider">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-brown-border/20">
                        @forelse($recentOrders as $order)
                            <tr class="hover:bg-cream/50 transition-colors">
                                <td class="py-3 px-6 text-sm font-medium text-brown-text">#{{ $order->id }}</td>
                                <td class="py-3 px-4 text-sm text-brown-text">{{ $order->customer_name }}</td>
                                <td class="py-3 px-4 text-sm font-medium text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td class="py-3 px-4">
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
                                <td class="py-3 px-4 text-sm text-brown-muted">{{ $order->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-brown-muted text-sm">Belum ada pesanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
