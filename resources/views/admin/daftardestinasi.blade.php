<x-admin-layout :title="$title">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">{{ $title }}</h2>

    @if (session('success'))
        <div class="my-3 rounded border border-green-200 bg-green-50 px-4 py-2 text-sm text-green-800">{{ session('success') }}</div>
    @endif

    <div class="mt-3 rounded bg-white px-6 py-4 shadow sm:px-1 sm:py-1">
        <div class="grid grid-cols-1 p-4 md:grid-cols-2">
            <div class="mb-3 md:mb-0">
                <a href="{{ route('admin.destinasi.create') }}">
                    <button type="button" class="rounded border border-forest px-4 py-1 text-sm font-semibold text-forest hover:border-transparent hover:bg-forest hover:text-white focus:outline-none">Tambah</button>
                </a>
            </div>

            <div>
                {{-- PENCARIAN & FILTER (method GET agar parameter tampil di address bar) --}}
                <form action="{{ route('admin.destinasi.index') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div>
                            <select name="id_kategori" class="block w-full rounded-l-2xl border border-gray-300 bg-white px-4 py-2 shadow-sm focus:outline-none sm:text-sm">
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategoris as $k)
                                    <option value="{{ $k->id_kategori }}" {{ request('id_kategori') == $k->id_kategori ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex">
                            <input type="text" name="s" value="{{ request('s') }}" placeholder="Cari nama..."
                                   class="w-full border border-gray-300 px-4 py-2 sm:text-sm">
                            <button type="submit" class="rounded-r-md border border-l-0 border-gray-300 bg-gray-50 px-4 py-1 text-forest hover:bg-forest hover:text-white">Cari</button>
                        </div>
                    </div>
                </form>
                {{-- END PENCARIAN --}}
            </div>
        </div>

        <div class="inline-block min-w-full py-2 align-middle sm:px-4 lg:px-4">
            <div class="overflow-x-auto border-b border-gray-200 shadow sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Destinasi</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Harga</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Kategori</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse ($destinasis as $item)
                            <tr>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="flex items-center">
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ asset($item->foto) }}" alt="">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $item->nama }}</div>
                                            <div class="text-sm text-gray-500">{{ $item->lokasi }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div class="text-sm text-gray-900">Rp {{ number_format($item->harga_dewasa, 0, ',', '.') }}</div>
                                    <div class="text-sm text-gray-500">Anak Rp {{ number_format($item->harga_anak, 0, ',', '.') }}</div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                    {{-- memanggil relasi kategori() pada model Destinasi --}}
                                    @if ($item->kategori)
                                        <a href="{{ route('admin.destinasi.kategori', $item->kategori->id_kategori) }}" class="text-forest hover:underline">{{ $item->kategori->nama_kategori }}</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm">
                                    @if ($item->status === 'Y')
                                        <span class="rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-medium text-forest">Aktif</span>
                                    @else
                                        <span class="rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-600">Non-Aktif</span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                    <form action="{{ route('admin.destinasi.destroy', $item->id_destinasi) }}" method="POST" class="flex justify-end gap-3">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('admin.destinasi.edit', $item->id_destinasi) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <button class="text-red-600 hover:text-red-900" onclick="return confirm('Anda Yakin ?')" type="submit">Del</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-6 py-6 text-center text-sm text-gray-500">Data tidak ditemukan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- PAGINATION (membawa parameter pencarian dan filter) --}}
        <div class="m-4">{{ $destinasis->appends(request()->query())->links() }}</div>
    </div>
</x-admin-layout>
