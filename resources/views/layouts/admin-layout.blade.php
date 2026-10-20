<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ? $title.' | ' : '' }}Admin Bali Ticket</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { colors: {
                forest: { DEFAULT: '#00563f', light: '#0b684d' },
                sand: '#f8f8f5', ink: '#16352c', sage: '#8aa58f',
            } } },
        };
    </script>
    <style>
        [x-cloak] { display: none !important; }
        body { color: #16352c; }
        h1, h2, h3, .font-brand { font-family: "Playfair Display", Georgia, serif; }
        .nav-item:hover, .active-nav-link { background: #0b684d; }
        .account-link:hover { background: #00563f; }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>
</head>
<body class="flex bg-sand">
    {{-- Sidebar (desktop) --}}
    <aside class="relative hidden h-screen w-64 bg-forest shadow-xl sm:block">
        <div class="p-6">
            <a href="{{ route('dashboard') }}" class="font-brand text-2xl font-semibold text-white hover:text-gray-300">Bali Ticket</a>
            <p class="text-xs uppercase tracking-widest text-white/60">Admin</p>
        </div>
        <nav class="pt-3 text-base font-semibold text-white">
            <a href="{{ route('dashboard') }}"
               class="nav-item flex items-center py-4 pl-6 {{ request()->routeIs('dashboard') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }}">
                📊&nbsp; Dashboard
            </a>
            <a href="{{ route('admin.destinasi.index') }}"
               class="nav-item flex items-center py-4 pl-6 {{ request()->routeIs('admin.destinasi.*') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }}">
                🏝️&nbsp; Destinasi
            </a>
            <a href="{{ route('home') }}" class="nav-item flex items-center py-4 pl-6 opacity-75 hover:opacity-100">
                🌐&nbsp; Lihat Website
            </a>
        </nav>
    </aside>

    <div class="relative flex h-screen w-full flex-col overflow-y-hidden">
        {{-- Header desktop --}}
        <header class="hidden w-full items-center bg-white px-6 py-2 sm:flex">
            <div class="w-1/2"></div>
            <div x-data="{ isOpen: false }" class="relative flex w-1/2 justify-end">
                <button @click="isOpen = !isOpen"
                        class="relative z-10 flex h-12 w-12 items-center justify-center rounded-full border-4 border-sage bg-forest font-bold text-white hover:border-forest-light focus:outline-none">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </button>
                <button x-show="isOpen" x-cloak @click="isOpen = false" class="fixed inset-0 h-full w-full cursor-default"></button>
                <div x-show="isOpen" x-cloak class="absolute z-20 mt-16 w-40 rounded-lg bg-white py-2 shadow-lg">
                    <p class="px-4 py-1 text-xs text-gray-500">{{ Auth::user()->name }}</p>
                    <a href="{{ route('profile.edit') }}" class="account-link block px-4 py-2 hover:text-white">Account</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="account-link block w-full px-4 py-2 text-left hover:text-white">Sign Out</button>
                    </form>
                </div>
            </div>
        </header>

        {{-- Header & menu mobile --}}
        <header x-data="{ isOpen: false }" class="w-full bg-forest px-6 py-5 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="{{ route('dashboard') }}" class="font-brand text-2xl font-semibold text-white">Bali Ticket Admin</a>
                <button @click="isOpen = !isOpen" class="text-3xl text-white focus:outline-none">☰</button>
            </div>
            <nav x-show="isOpen" x-cloak class="flex flex-col pt-4 text-white">
                <a href="{{ route('dashboard') }}" class="nav-item py-2 pl-4">Dashboard</a>
                <a href="{{ route('admin.destinasi.index') }}" class="nav-item py-2 pl-4">Destinasi</a>
                <a href="{{ route('home') }}" class="nav-item py-2 pl-4">Lihat Website</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-item w-full py-2 pl-4 text-left">Sign Out</button>
                </form>
            </nav>
        </header>

        <div class="flex h-screen w-full flex-col overflow-x-hidden overflow-y-auto border-t">
            <main class="w-full flex-grow p-6">
                {{ $slot }}
            </main>
            <footer class="w-full bg-white p-4 text-right text-sm text-gray-600">
                © 2026 Bali Ticket | Admin
            </footer>
        </div>
    </div>
</body>
</html>
