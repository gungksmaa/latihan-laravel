<x-home-layout :title="$title">
    <section class="mx-auto grid max-w-5xl gap-6 p-6 lg:grid-cols-3">
        <div class="lg:col-span-2">
            <h1 class="mb-4 text-2xl font-bold">Checkout</h1>
            <form class="space-y-4 rounded-lg border bg-white p-4 shadow">
                <label class="block text-sm">Nama lengkap
                    <input type="text" class="mt-1 w-full rounded border px-3 py-2" placeholder="Nama pemesan">
                </label>
                <label class="block text-sm">Email
                    <input type="email" class="mt-1 w-full rounded border px-3 py-2" placeholder="nama@email.com">
                </label>
                <label class="block text-sm">No. WhatsApp
                    <input type="tel" class="mt-1 w-full rounded border px-3 py-2" placeholder="08xxxxxxxxxx">
                </label>
                <label class="block text-sm">Metode pembayaran
                    <select class="mt-1 w-full rounded border bg-white px-3 py-2">
                        <option>Transfer Bank</option>
                        <option>E-Wallet</option>
                        <option>Bayar di Lokasi</option>
                    </select>
                </label>
                <button type="button" class="rounded-lg bg-forest px-4 py-2 text-white hover:bg-forest-light">Place order</button>
            </form>
        </div>

        <aside class="self-start rounded-lg border bg-white p-4 shadow">
            <h2 class="mb-3 text-xl font-semibold">Ringkasan</h2>
            @php $total = 0; @endphp
            @foreach ($item as $p)
                @php $total += $p->harga_dewasa * 2; @endphp
                <div class="flex justify-between border-b py-2 text-sm">
                    <span>{{ $p->nama }} × 2</span>
                    <span>Rp {{ number_format($p->harga_dewasa * 2, 0, ',', '.') }}</span>
                </div>
            @endforeach
            <p class="mt-3 flex justify-between font-semibold text-forest">
                <span>Total</span><span>Rp {{ number_format($total, 0, ',', '.') }}</span>
            </p>
        </aside>
    </section>
</x-home-layout>
