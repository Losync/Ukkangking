@extends('admin.layouts.app')
@section('title', 'Kelola Produk')
@section('page-title', 'Produk')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <p class="text-brown-muted text-sm">Kelola semua produk kue</p>
        <a href="{{ route('admin.products.create') }}" class="bg-primary text-white px-5 py-2.5 rounded-xl hover:bg-primary-dark transition-colors font-medium text-sm flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Tambah Produk
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-brown-border/30 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-cream">
                    <tr>
                        <th class="text-left py-3 px-6 text-xs font-semibold text-brown-muted uppercase tracking-wider">No</th>
                        <th class="text-left py-3 px-4 text-xs font-semibold text-brown-muted uppercase tracking-wider">Gambar</th>
                        <th class="text-left py-3 px-4 text-xs font-semibold text-brown-muted uppercase tracking-wider">Nama</th>
                        <th class="text-left py-3 px-4 text-xs font-semibold text-brown-muted uppercase tracking-wider">Kategori</th>
                        <th class="text-right py-3 px-4 text-xs font-semibold text-brown-muted uppercase tracking-wider">Harga</th>
                        <th class="text-center py-3 px-4 text-xs font-semibold text-brown-muted uppercase tracking-wider">Stok</th>
                        <th class="text-center py-3 px-4 text-xs font-semibold text-brown-muted uppercase tracking-wider">Status</th>
                        <th class="text-center py-3 px-4 text-xs font-semibold text-brown-muted uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brown-border/20">
                    @forelse($products as $index => $product)
                        <tr class="hover:bg-cream/50 transition-colors">
                            <td class="py-3 px-6 text-sm text-brown-muted">{{ $products->firstItem() + $index }}</td>
                            <td class="py-3 px-4">
                                <div class="w-12 h-12 bg-brown-light rounded-xl overflow-hidden">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-brown-border" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="py-3 px-4 text-sm font-medium text-brown-text">{{ $product->name }}</td>
                            <td class="py-3 px-4 text-sm text-brown-muted">{{ $product->category->name ?? '-' }}</td>
                            <td class="py-3 px-4 text-sm font-medium text-primary text-right">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="py-3 px-4 text-center text-sm">
                                <span class="{{ $product->stock > 0 ? 'text-green-600' : 'text-red-500' }} font-medium">{{ $product->stock }}</span>
                            </td>
                            <td class="py-3 px-4 text-center">
                                @if($product->is_active)
                                    <span class="bg-green-100 text-green-700 text-xs px-2.5 py-1 rounded-full font-medium">Aktif</span>
                                @else
                                    <span class="bg-red-100 text-red-600 text-xs px-2.5 py-1 rounded-full font-medium">Nonaktif</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-500 hover:text-blue-700 transition-colors p-1" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-600 transition-colors p-1" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-8 text-center text-brown-muted text-sm">Belum ada produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($products->hasPages())
            <div class="px-6 py-4 border-t border-brown-border/30">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection
