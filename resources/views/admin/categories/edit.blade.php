@extends('admin.layouts.app')
@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori')

@section('content')
    <div class="max-w-2xl">
        <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center gap-1 text-sm text-brown-muted hover:text-primary transition-colors mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali
        </a>

        <div class="bg-white rounded-2xl shadow-sm border border-brown-border/30 p-6">
            <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-brown-text mb-1">Nama Kategori *</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required
                            class="w-full px-4 py-2.5 rounded-xl border border-brown-border bg-cream focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors text-sm">
                        @error('name')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-brown-text mb-1">Gambar</label>
                        @if($category->image)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-24 h-24 rounded-xl object-cover">
                            </div>
                        @endif
                        <input type="file" name="image" id="image" accept="image/*"
                            class="w-full px-4 py-2.5 rounded-xl border border-brown-border bg-cream focus:outline-none focus:border-primary text-sm file:mr-4 file:py-1 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                        <p class="text-xs text-brown-muted mt-1">Biarkan kosong jika tidak ingin mengubah gambar</p>
                        @error('image')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="flex gap-3 mt-8">
                    <button type="submit" class="bg-primary text-white px-6 py-2.5 rounded-xl hover:bg-primary-dark transition-colors font-medium text-sm">Perbarui</button>
                    <a href="{{ route('admin.categories.index') }}" class="border border-brown-border text-brown-text px-6 py-2.5 rounded-xl hover:bg-cream transition-colors text-sm font-medium">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
