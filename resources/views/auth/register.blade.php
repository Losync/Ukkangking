<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - Sofia Snack</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cream font-sans antialiased min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/logosofia.svg') }}" alt="Sofia Snack" class="h-16 mx-auto">
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-lg border border-brown-border/30 p-8">
            <h2 class="text-2xl font-bold text-brown-text text-center mb-2">Daftar Akun</h2>
            <p class="text-brown-muted text-center text-sm mb-6">Buat akun baru di Sofia Snack</p>

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm mb-6">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-brown-text mb-1">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                            class="w-full px-4 py-3 rounded-xl border border-brown-border bg-cream focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors text-sm">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-brown-text mb-1">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-brown-border bg-cream focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors text-sm">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-brown-text mb-1">Password</label>
                        <input type="password" name="password" id="password" required
                            class="w-full px-4 py-3 rounded-xl border border-brown-border bg-cream focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors text-sm">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-brown-text mb-1">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="w-full px-4 py-3 rounded-xl border border-brown-border bg-cream focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors text-sm">
                    </div>
                </div>
                <button type="submit" class="w-full bg-primary text-white py-3 rounded-xl hover:bg-primary-dark transition-colors font-semibold mt-6">
                    Daftar
                </button>
            </form>

            <p class="text-center text-sm text-brown-muted mt-6">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-primary font-medium hover:text-primary-dark transition-colors">Masuk</a>
            </p>
        </div>

        <p class="text-center text-sm text-brown-muted mt-6">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors">&larr; Kembali ke Beranda</a>
        </p>
    </div>
</body>
</html>
