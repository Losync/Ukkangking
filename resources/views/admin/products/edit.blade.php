@extends('admin.layouts.app')
@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')

@section('content')
    <div class="max-w-2xl">
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-1 text-sm text-brown-muted hover:text-primary transition-colors mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali
        </a>

        <div class="bg-white rounded-2xl shadow-sm border border-brown-border/30 p-6">
            <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-brown-text mb-1">Nama Produk *</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                            class="w-full px-4 py-2.5 rounded-xl border border-brown-border bg-cream focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors text-sm">
                        @error('name')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-brown-text mb-1">Kategori *</label>
                        <select name="category_id" id="category_id" required
                            class="w-full px-4 py-2.5 rounded-xl border border-brown-border bg-cream focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors text-sm">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-brown-text mb-1">Deskripsi</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full px-4 py-2.5 rounded-xl border border-brown-border bg-cream focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors text-sm resize-none">{{ old('description', $product->description) }}</textarea>
                        @error('description')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="price" class="block text-sm font-medium text-brown-text mb-1">Harga (Rp) *</label>
                            <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" required min="0"
                                class="w-full px-4 py-2.5 rounded-xl border border-brown-border bg-cream focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors text-sm">
                            @error('price')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label for="stock" class="block text-sm font-medium text-brown-text mb-1">Stok *</label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" required min="0"
                                class="w-full px-4 py-2.5 rounded-xl border border-brown-border bg-cream focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors text-sm">
                            @error('stock')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-brown-text mb-1">Gambar Produk</label>
                        @if($product->image)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-24 h-24 rounded-xl object-cover">
                            </div>
                        @endif
                        <input type="file" name="image" id="image" accept="image/*"
                            class="w-full px-4 py-2.5 rounded-xl border border-brown-border bg-cream focus:outline-none focus:border-primary text-sm file:mr-4 file:py-1 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                        <p class="text-xs text-brown-muted mt-1">Biarkan kosong jika tidak ingin mengubah gambar</p>
                        @error('image')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                            class="w-4 h-4 rounded border-brown-border text-primary focus:ring-primary">
                        <label for="is_active" class="text-sm text-brown-text">Produk Aktif</label>
                    </div>
                </div>

                <div class="flex gap-3 mt-8">
                    <button type="submit" class="bg-primary text-white px-6 py-2.5 rounded-xl hover:bg-primary-dark transition-colors font-medium text-sm">Perbarui</button>
                    <a href="{{ route('admin.products.index') }}" class="border border-brown-border text-brown-text px-6 py-2.5 rounded-xl hover:bg-cream transition-colors text-sm font-medium">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
