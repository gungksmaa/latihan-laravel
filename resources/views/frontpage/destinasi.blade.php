<x-home-layout :title="$title">
    {{-- Search & Filter (GET: ?q=...&kategori=...) --}}
    <form method="GET" action="{{ route('destinasi') }}"
          class="flex flex-col items-center justify-between gap-2 bg-gray-100 p-4 md:flex-row">
        <input type="search" name="q" value="{{ $q }}" placeholder="Cari destinasi..."
               class="w-full rounded-lg border bg-white px-4 py-2 md:w-1/3">
        <div class="flex w-full gap-2 md:w-auto">
            <select name="kategori" class="w-full rounded-lg border bg-white px-4 py-2 md:w-auto">
                @foreach ($kategori as $id => $label)
                    <option value="{{ $id }}" @selected($kategoriDipilih === $id)>{{ $label }}</option>
                @endforeach
            </select>
            <button type="submit" class="rounded-lg bg-forest px-4 py-2 text-white hover:bg-forest-light">Cari</button>
        </div>
    </form>

    <section class="mx-auto max-w-7xl p-6">
        <h1 class="mb-2 text-2xl font-bold">Daftar Destinasi</h1>
        <p class="mb-4 text-sm text-gray-600">{{ count($daftar) }} destinasi ditemukan</p>

        @if (count($daftar) === 0)
            <p class="text-gray-600">Destinasi tidak ditemukan. Coba kata kunci atau kategori lain.</p>
        @else
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($daftar as $p)
                    @include('frontpage.partials.card', ['p' => $p])
                @endforeach
            </div>
        @endif
    </section>
</x-home-layout>
