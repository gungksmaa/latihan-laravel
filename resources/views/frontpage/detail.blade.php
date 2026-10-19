<x-home-layout :title="$title">
    <section class="mx-auto max-w-4xl p-6"
             x-data="{ jenis: 'Adult', jumlah: 1, harga: { Adult: {{ $p['price'] }}, Child: {{ $p['child_price'] }} },
                       rupiah(n) { return 'Rp ' + Number(n || 0).toLocaleString('id-ID'); } }">
        <a href="{{ route('destinasi') }}" class="text-forest hover:underline">← Kembali</a>

        <div class="mt-4 rounded-lg border bg-white p-4 shadow">
            <img src="{{ asset('images/'.$p['img']) }}" alt="{{ $p['name'] }}"
                 class="mb-4 aspect-[16/8] w-full rounded-lg bg-sage/20 object-cover">
            <h1 class="text-2xl font-bold">{{ $p['name'] }}</h1>
            <p class="text-gray-600">📍 {{ $p['location'] }} · {{ $p['category_name'] }}</p>
            <p class="mt-3">{{ $p['description'] }}</p>
            <p class="mt-3 text-sm text-gray-600">🕒 {{ $p['opening_hours'] }} · ⏱️ {{ $p['duration'] }}</p>

            {{-- Pilih tiket (prototipe: tombol mengarah ke halaman keranjang statis) --}}
            <form method="GET" action="{{ route('keranjang') }}" class="mt-4 border-t pt-4">
                <div class="grid gap-3 sm:grid-cols-3">
                    <label class="text-sm">Jenis tiket
                        <select name="jenis" x-model="jenis" class="mt-1 w-full rounded border bg-white px-3 py-2">
                            <option value="Adult">Dewasa — Rp {{ number_format($p['price'], 0, ',', '.') }}</option>
                            <option value="Child">Anak-anak — Rp {{ number_format($p['child_price'], 0, ',', '.') }}</option>
                        </select>
                    </label>
                    <label class="text-sm">Tanggal kunjungan
                        <input type="date" name="tanggal" min="{{ date('Y-m-d') }}" required class="mt-1 w-full rounded border px-3 py-2">
                    </label>
                    <label class="text-sm">Jumlah tiket
                        <input type="number" name="jumlah" x-model="jumlah" min="1" max="20" class="mt-1 w-full rounded border px-3 py-2">
                    </label>
                </div>
                <p class="mt-3 text-lg font-semibold text-forest">Subtotal: <span x-text="rupiah(harga[jenis] * jumlah)"></span></p>
                <input type="hidden" name="destinasi" value="{{ $p['slug'] }}">
                <div class="mt-3 flex flex-wrap items-center gap-3">
                    <button type="submit" class="rounded-lg bg-forest px-4 py-2 text-white hover:bg-forest-light">Add to Cart</button>
                    <a href="{{ route('keranjang') }}" class="text-forest hover:underline">Lihat Keranjang →</a>
                </div>
            </form>
        </div>
    </section>
</x-home-layout>
