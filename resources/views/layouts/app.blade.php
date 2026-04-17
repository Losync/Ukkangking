<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sofia Snack - Toko Kue & Snack Terbaik. Tersedia berbagai macam kue basah, kue kering, roti, dan pastry.">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Sofia Snack - Toko Kue & Snack')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cream text-brown-text font-sans antialiased">
    {{-- Navbar --}}
    <nav class="bg-white shadow-sm border-b border-brown-border sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-lg">S</span>
                    </div>
                    <span class="text-xl font-bold text-primary">Sofia Snack</span>
                </a>

                {{-- Desktop Menu --}}
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="text-brown-text hover:text-primary font-medium transition-colors {{ request()->routeIs('home') ? 'text-primary' : '' }}">Beranda</a>
                    <a href="{{ route('products.index') }}" class="text-brown-text hover:text-primary font-medium transition-colors {{ request()->routeIs('products.*') ? 'text-primary' : '' }}">Produk</a>
                    <a href="{{ route('cart.index') }}" class="relative text-brown-text hover:text-primary transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                        @if(session('cart') && count(session('cart')) > 0)
                            <span class="absolute -top-2 -right-2 bg-accent text-white text-xs w-5 h-5 rounded-full flex items-center justify-center font-bold">{{ count(session('cart')) }}</span>
                        @endif
                    </a>
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary-dark transition-colors font-medium text-sm">Dashboard</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-brown-muted hover:text-primary font-medium transition-colors text-sm">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-primary hover:text-primary-dark font-medium transition-colors text-sm">Login</a>
                    @endauth
                </div>

                {{-- Mobile Menu Button --}}
                <button id="mobile-menu-btn" class="md:hidden text-brown-text">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            {{-- Mobile Menu --}}
            <div id="mobile-menu" class="hidden md:hidden pb-4">
                <div class="flex flex-col gap-3">
                    <a href="{{ route('home') }}" class="text-brown-text hover:text-primary font-medium">Beranda</a>
                    <a href="{{ route('products.index') }}" class="text-brown-text hover:text-primary font-medium">Produk</a>
                    <a href="{{ route('cart.index') }}" class="text-brown-text hover:text-primary font-medium">Keranjang
                        @if(session('cart') && count(session('cart')) > 0)
                            ({{ count(session('cart')) }})
                        @endif
                    </a>
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="text-primary font-medium">Dashboard</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-brown-muted hover:text-primary font-medium">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-primary font-medium">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div id="flash-success" class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700">&times;</button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex justify-between items-center">
                <span>{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">&times;</button>
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-primary-dark text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-10 h-10 bg-secondary rounded-full flex items-center justify-center">
                            <span class="text-primary-dark font-bold text-lg">S</span>
                        </div>
                        <span class="text-xl font-bold">Sofia Snack</span>
                    </div>
                    <p class="text-secondary-light text-sm leading-relaxed">Menyajikan berbagai kue dan snack berkualitas dengan cita rasa terbaik untuk setiap momen spesial Anda.</p>
                </div>
                <div>
                    <h3 class="font-semibold text-lg mb-4">Menu</h3>
                    <ul class="space-y-2 text-secondary-light text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-white transition-colors">Produk</a></li>
                        <li><a href="{{ route('cart.index') }}" class="hover:text-white transition-colors">Keranjang</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold text-lg mb-4">Kontak</h3>
                    <ul class="space-y-2 text-secondary-light text-sm">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Jl. Raya No. 123, Jakarta
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            (021) 1234-5678
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            info@sofiasnack.com
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-primary-light mt-8 pt-8 text-center text-secondary-light text-sm">
                <p>&copy; {{ date('Y') }} Sofia Snack. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
            document.getElementById('mobile-menu')?.classList.toggle('hidden');
        });

        // Auto-hide flash messages
        setTimeout(() => {
            document.getElementById('flash-success')?.remove();
        }, 4000);
    </script>

    @stack('scripts')
</body>
</html>
