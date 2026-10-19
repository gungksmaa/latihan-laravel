<div class="rounded-lg border bg-white p-4 shadow hover:shadow-lg">
    <img src="{{ asset('images/'.$p['img']) }}" alt="{{ $p['name'] }}" loading="lazy"
         class="mb-3 aspect-[16/10] w-full rounded-md bg-sage/20 object-cover">
    <h2 class="font-semibold">{{ $p['name'] }}</h2>
    <p class="text-sm text-gray-500">📍 {{ $p['location'] }}</p>
    <p class="text-gray-600">Rp {{ number_format($p['price'], 0, ',', '.') }} <span class="text-xs">/ tiket dewasa</span></p>

    <a href="{{ route('detail', $p['slug']) }}" class="mt-2 block text-forest hover:underline">Lihat Detail</a>
    <a href="{{ route('detail', $p['slug']) }}" class="mt-3 inline-flex rounded-lg bg-forest px-4 py-2 text-white hover:bg-forest-light">Pesan Tiket</a>
</div>
