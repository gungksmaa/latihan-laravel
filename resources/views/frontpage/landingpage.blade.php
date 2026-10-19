<x-home-layout :title="$title">
    {{-- Hero: Call to Action --}}
    <section class="bg-forest px-6 py-16 text-white">
        <div class="mx-auto max-w-5xl text-center">
            <h1 class="text-4xl font-bold md:text-5xl">Jelajahi Bali, Pesan Tiketnya dari Sini</h1>
            <p class="mx-auto mt-4 max-w-2xl text-white/80">
                Tiket masuk pura, sawah terasering, pantai, hingga taman budaya. Pilih destinasi, tanggal, dan jumlah tiket dalam beberapa langkah.
            </p>
            <div class="mt-8 flex flex-wrap justify-center gap-3">
                <a href="{{ route('destinasi') }}" class="rounded-lg bg-white px-6 py-3 font-semibold text-forest hover:bg-sand">Lihat Destinasi</a>
                <a href="{{ route('promo') }}" class="rounded-lg border border-white/60 px-6 py-3 font-semibold hover:bg-white/10">Lihat Promo</a>
            </div>
        </div>
    </section>

    {{-- Destinasi unggulan --}}
    <section class="mx-auto max-w-7xl p-6 py-12">
        <div class="mb-6 flex items-end justify-between">
            <h2 class="text-2xl font-bold">Destinasi Unggulan</h2>
            <a href="{{ route('destinasi') }}" class="text-forest hover:underline">Semua destinasi →</a>
        </div>
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($unggulan as $p)
                @include('frontpage.partials.card', ['p' => $p])
            @endforeach
        </div>
    </section>

    {{-- Langkah pemesanan --}}
    <section class="bg-white px-6 py-12">
        <div class="mx-auto max-w-5xl">
            <h2 class="mb-8 text-center text-2xl font-bold">Cara Memesan</h2>
            <div class="grid gap-6 text-center sm:grid-cols-3">
                <div><p class="text-3xl">🏝️</p><h3 class="mt-2 font-semibold">1. Pilih Destinasi</h3><p class="text-sm text-gray-600">Cari dan lihat detail destinasi.</p></div>
                <div><p class="text-3xl">🎟️</p><h3 class="mt-2 font-semibold">2. Pilih Tiket</h3><p class="text-sm text-gray-600">Tentukan jenis tiket, tanggal, dan jumlah.</p></div>
                <div><p class="text-3xl">✅</p><h3 class="mt-2 font-semibold">3. Checkout</h3><p class="text-sm text-gray-600">Isi data pemesan dan konfirmasi.</p></div>
            </div>
        </div>
    </section>
</x-home-layout>
