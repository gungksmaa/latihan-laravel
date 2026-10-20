<x-admin-layout :title="$title">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">{{ $title }}</h2>

    <div class="mt-3 rounded bg-white px-6 py-4 shadow sm:px-1 sm:py-1">
        <div class="container mx-auto">
            {{-- jika ada $destinasi => form update (PUT), jika tidak => form tambah (POST) --}}
            <form enctype="multipart/form-data" method="POST"
                  action="{{ isset($destinasi) ? route('admin.destinasi.update', $destinasi->id_destinasi) : route('admin.destinasi.store') }}">
                @csrf
                @if (isset($destinasi)) @method('PUT') @endif

                <div class="bg-white px-2 py-8 sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Destinasi</label>
                            <input type="text" id="nama" name="nama" placeholder="Contoh: Tanah Lot" value="{{ old('nama', $destinasi->nama ?? '') }}"
                                   class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm sm:text-sm">
                            @error('nama') <div class="text-xs text-red-800">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="id_kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                            <select id="id_kategori" name="id_kategori" class="mt-1 block w-full rounded-md border border-gray-300 bg-white px-3 py-2 shadow-sm sm:text-sm">
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategoris as $k)
                                    <option value="{{ $k->id_kategori }}" {{ old('id_kategori', $destinasi->id_kategori ?? '') == $k->id_kategori ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('id_kategori') <div class="text-xs text-red-800">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-2">
                            <label for="harga_dewasa" class="block text-sm font-medium text-gray-700">Harga Dewasa (Rp)</label>
                            <input type="number" id="harga_dewasa" name="harga_dewasa" min="0" step="1000" value="{{ old('harga_dewasa', $destinasi->harga_dewasa ?? '') }}"
                                   class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm sm:text-sm">
                            @error('harga_dewasa') <div class="text-xs text-red-800">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-2">
                            <label for="harga_anak" class="block text-sm font-medium text-gray-700">Harga Anak (Rp)</label>
                            <input type="number" id="harga_anak" name="harga_anak" min="0" step="1000" value="{{ old('harga_anak', $destinasi->harga_anak ?? '') }}"
                                   class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm sm:text-sm">
                            @error('harga_anak') <div class="text-xs text-red-800">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-2">
                            <label for="kuota" class="block text-sm font-medium text-gray-700">Kuota Tiket</label>
                            <input type="number" id="kuota" name="kuota" min="1" value="{{ old('kuota', $destinasi->kuota ?? 500) }}"
                                   class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm sm:text-sm">
                            @error('kuota') <div class="text-xs text-red-800">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-2">
                            <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
                            <input type="text" id="lokasi" name="lokasi" placeholder="Ubud, Gianyar" value="{{ old('lokasi', $destinasi->lokasi ?? '') }}"
                                   class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm sm:text-sm">
                            @error('lokasi') <div class="text-xs text-red-800">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-2">
                            <label for="jam_buka" class="block text-sm font-medium text-gray-700">Jam Buka</label>
                            <input type="text" id="jam_buka" name="jam_buka" placeholder="08.00 – 18.00 WITA" value="{{ old('jam_buka', $destinasi->jam_buka ?? '') }}"
                                   class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm sm:text-sm">
                            @error('jam_buka') <div class="text-xs text-red-800">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-2">
                            <label for="durasi" class="block text-sm font-medium text-gray-700">Durasi Kunjungan</label>
                            <input type="text" id="durasi" name="durasi" placeholder="1 – 2 jam" value="{{ old('durasi', $destinasi->durasi ?? '') }}"
                                   class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm sm:text-sm">
                            @error('durasi') <div class="text-xs text-red-800">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="foto" class="block text-sm font-medium text-gray-700">Foto (png/jpg, maks 1 MB)</label>
                            @if (isset($destinasi))
                                <img src="{{ asset($destinasi->foto) }}" alt="" class="mb-2 mt-1 h-16 w-24 rounded object-cover">
                                <p class="text-xs text-gray-500">Kosongkan jika tidak ingin mengganti foto.</p>
                            @endif
                            <input type="file" id="foto" name="foto" class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm sm:text-sm">
                            @error('foto') <div class="text-xs text-red-800">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" rows="3"
                                      class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm sm:text-sm">{{ old('deskripsi', $destinasi->deskripsi ?? '') }}</textarea>
                            @error('deskripsi') <div class="text-xs text-red-800">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            @php $status = old('status', $destinasi->status ?? 'Y'); @endphp
                            <label class="mr-4"><input type="radio" name="status" value="Y" {{ $status === 'Y' ? 'checked' : '' }}> Aktif</label>
                            <label><input type="radio" name="status" value="N" {{ $status === 'N' ? 'checked' : '' }}> Non-Aktif</label>
                            @error('status') <div class="text-xs text-red-800">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <hr>
                <div class="bg-white px-4 py-3 text-right sm:px-6">
                    <a href="{{ route('admin.destinasi.index') }}" class="mr-3 text-sm text-gray-600 hover:underline">Batal</a>
                    <button type="submit" class="inline-flex w-24 justify-center rounded-md bg-forest px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-forest-light">Save</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
