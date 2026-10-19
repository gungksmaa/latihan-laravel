<x-home-layout :title="$title">
    <section class="mx-auto max-w-4xl p-6">
        <h1 class="mb-4 text-2xl font-bold">Your Cart</h1>
        <p class="mb-4 text-sm text-gray-500">Contoh isi keranjang (statis). Logika keranjang asli dibuat di modul berikutnya.</p>

        @php $total = 0; @endphp
        <div class="space-y-4">
            @foreach ($item as $p)
                @php $total += $p['price'] * 2; @endphp
                <div class="flex flex-col gap-3 rounded-lg border bg-white p-4 shadow-sm md:flex-row md:items-center md:justify-between">
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('images/'.$p['img']) }}" alt="{{ $p['name'] }}" class="h-16 w-16 rounded-md bg-sage/20 object-cover">
                        <div>
                            <h2 class="font-semibold">{{ $p['name'] }}</h2>
                            <p class="text-gray-600">Rp {{ number_format($p['price'], 0, ',', '.') }} / tiket · Dewasa × 2</p>
                            <p class="text-sm text-gray-500">Subtotal: Rp {{ number_format($p['price'] * 2, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <button type="button" class="rounded-lg bg-red-500 px-3 py-1 text-white hover:bg-red-600">Delete</button>
                </div>
            @endforeach
        </div>

        <div class="mt-6 flex flex-col items-center justify-between gap-3 sm:flex-row">
            <p class="text-lg font-semibold">Total: Rp {{ number_format($total, 0, ',', '.') }}</p>
            <div class="flex items-center gap-4">
                <a href="{{ route('destinasi') }}" class="text-forest hover:underline">← Lanjut memilih</a>
                <a href="{{ route('checkout') }}" class="rounded-lg bg-forest px-4 py-2 text-white hover:bg-forest-light">Proceed to checkout</a>
            </div>
        </div>
    </section>
</x-home-layout>
