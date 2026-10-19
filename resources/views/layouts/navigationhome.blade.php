<nav x-data="{ open: false }" class="bg-forest px-6 py-4 text-white">
    <div class="flex items-center justify-between">
        <a href="{{ route('home') }}" class="font-serif text-xl font-bold">Bali Ticket</a>

        <button class="rounded border border-white/60 p-2 md:hidden" @click="open = !open" aria-label="Buka menu">☰</button>

        <div class="hidden items-center gap-6 md:flex">
            <a href="{{ route('home') }}" class="hover:text-gray-200">Beranda</a>
            <a href="{{ route('destinasi') }}" class="hover:text-gray-200">Destinasi</a>
            <a href="{{ route('promo') }}" class="hover:text-gray-200">Promo</a>
            <a href="{{ route('keranjang') }}" class="hover:text-gray-200">Keranjang</a>
            <a href="{{ route('checkout') }}" class="hover:text-gray-200">Checkout</a>
            <a href="{{ route('login') }}" class="hover:text-gray-200">Login</a>
            <a href="{{ route('register') }}" class="rounded-lg bg-white px-4 py-1 font-semibold text-forest hover:bg-sand">Register</a>
        </div>
    </div>

    <div x-show="open" x-cloak class="mt-4 flex flex-col gap-3 md:hidden">
        <a href="{{ route('home') }}">Beranda</a>
        <a href="{{ route('destinasi') }}">Destinasi</a>
        <a href="{{ route('promo') }}">Promo</a>
        <a href="{{ route('keranjang') }}">Keranjang</a>
        <a href="{{ route('checkout') }}">Checkout</a>
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    </div>
</nav>
