<x-home-layout :title="$title">
    <section class="mx-auto max-w-5xl p-6">
        <h1 class="mb-6 text-2xl font-bold">Promo</h1>
        <div class="grid gap-6 md:grid-cols-3">
            @foreach ([
                ['Diskon Rombongan', '20%', 'Pemesanan minimal 10 tiket untuk satu destinasi dan tanggal.'],
                ['Tiket Anak Hemat', '40%', 'Harga tiket anak-anak jauh lebih murah dibanding tiket dewasa.'],
                ['Paket Keluarga', 'Rp 50.000', 'Potongan untuk pemesanan Bali Safari and Marine Park.'],
            ] as [$judul, $nilai, $ket])
                <div class="rounded-lg border bg-white p-5 shadow hover:shadow-lg">
                    <p class="text-3xl font-bold text-forest">{{ $nilai }}</p>
                    <h2 class="mt-2 font-semibold">{{ $judul }}</h2>
                    <p class="mt-1 text-sm text-gray-600">{{ $ket }}</p>
                    <a href="{{ route('destinasi') }}" class="mt-4 inline-block text-forest hover:underline">Pilih destinasi →</a>
                </div>
            @endforeach
        </div>
        <p class="mt-6 text-xs text-gray-500">Promo di atas contoh untuk prototipe.</p>
    </section>
</x-home-layout>
