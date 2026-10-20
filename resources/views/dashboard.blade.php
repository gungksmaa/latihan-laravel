<x-admin-layout :title="$title">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">Dashboard</h2>
    <p class="mb-6 text-sm text-gray-600">Selamat datang, {{ Auth::user()->name }}.</p>

    <div class="grid gap-6 md:grid-cols-3">
        <div class="rounded-lg border bg-white p-5 shadow">
            <p class="text-sm text-gray-500">Total Destinasi</p>
            <p class="mt-1 text-3xl font-bold text-forest">{{ $jumlahDestinasi }}</p>
        </div>
        <div class="rounded-lg border bg-white p-5 shadow">
            <p class="text-sm text-gray-500">Destinasi Aktif</p>
            <p class="mt-1 text-3xl font-bold text-forest">{{ $jumlahAktif }}</p>
        </div>
        <div class="rounded-lg border bg-white p-5 shadow">
            <p class="text-sm text-gray-500">Kategori</p>
            <p class="mt-1 text-3xl font-bold text-forest">{{ $jumlahKategori }}</p>
        </div>
    </div>

    <a href="{{ route('admin.destinasi.index') }}" class="mt-6 inline-block rounded-lg bg-forest px-4 py-2 text-white hover:bg-forest-light">Kelola Destinasi →</a>
</x-admin-layout>
