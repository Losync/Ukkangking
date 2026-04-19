<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Sofia Snack</title>
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
            <h2 class="text-2xl font-bold text-brown-text text-center mb-2">Masuk</h2>
            <p class="text-brown-muted text-center text-sm mb-6">Masuk ke akun Sofia Snack Anda</p>

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm mb-6">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-brown-text mb-1">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-4 py-3 rounded-xl border border-brown-border bg-cream focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors text-sm">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-brown-text mb-1">Password</label>
                        <input type="password" name="password" id="password" required
                            class="w-full px-4 py-3 rounded-xl border border-brown-border bg-cream focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-colors text-sm">
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded border-brown-border text-primary focus:ring-primary">
                        <label for="remember" class="ml-2 text-sm text-brown-muted">Ingat saya</label>
                    </div>
                </div>
                <button type="submit" class="w-full bg-primary text-white py-3 rounded-xl hover:bg-primary-dark transition-colors font-semibold mt-6">
                    Masuk
                </button>
            </form>

            <p class="text-center text-sm text-brown-muted mt-6">
                Belum punya akun? <a href="{{ route('register') }}" class="text-primary font-medium hover:text-primary-dark transition-colors">Daftar</a>
            </p>
        </div>

        <p class="text-center text-sm text-brown-muted mt-6">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors">&larr; Kembali ke Beranda</a>
        </p>
    </div>
</body>
</html>
