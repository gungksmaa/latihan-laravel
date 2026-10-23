<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FilterDestinasiRequest;
use App\Http\Requests\Api\StoreDestinasiRequest;
use App\Http\Requests\Api\UpdateDestinasiRequest;
use App\Http\Resources\DestinasiResource;
use App\Models\Destinasi;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DestinasiController extends Controller
{
    // GET /api/v1/destinasi?search=&kategori=&harga_min=&harga_max=&sort=&order=&per_page=&page=
    public function index(FilterDestinasiRequest $request)
    {
        $filter = $request->validated();
        $perPage = (int) ($filter['per_page'] ?? 10);

        $destinasis = Destinasi::with('kategori')
            ->aktif()
            ->filter($filter)
            ->paginate($perPage)
            ->withQueryString();

        return DestinasiResource::collection($destinasis);
    }

    // GET /api/v1/destinasi/{id}
    public function show(Destinasi $destinasi)
    {
        abort_if($destinasi->status !== 'Y', 404, 'Destinasi tidak ditemukan.');

        return new DestinasiResource($destinasi->load('kategori'));
    }

    // POST /api/v1/destinasi (admin)
    public function store(StoreDestinasiRequest $request)
    {
        // hanya data yang lolos validasi yang dipakai (aman dari mass assignment)
        $data = $request->safe()->except('foto');
        $data['slug'] = Destinasi::slugUnik($data['nama']);
        $data['foto'] = $this->simpanFoto($request->file('foto'));

        try {
            $destinasi = Destinasi::create($data);
        } catch (\Throwable $e) {
            $this->hapusFoto($data['foto']); // jangan tinggalkan file yatim
            throw $e;
        }

        return (new DestinasiResource($destinasi->load('kategori')))
            ->additional(['message' => 'Destinasi berhasil dibuat.'])
            ->response()
            ->setStatusCode(201);
    }

    // PUT/PATCH /api/v1/destinasi/{id} (admin)
    public function update(UpdateDestinasiRequest $request, Destinasi $destinasi)
    {
        $data = $request->safe()->except('foto');
        $fotoLama = null;

        if ($request->hasFile('foto')) {
            $fotoLama = $destinasi->foto;
            $data['foto'] = $this->simpanFoto($request->file('foto'));
        }

        $destinasi->update($data);

        if ($fotoLama) {
            $this->hapusFoto($fotoLama);
        }

        return (new DestinasiResource($destinasi->fresh('kategori')))
            ->additional(['message' => 'Destinasi berhasil diperbarui.']);
    }

    // DELETE /api/v1/destinasi/{id} (admin)
    public function destroy(Destinasi $destinasi)
    {
        $foto = $destinasi->foto;
        $destinasi->delete();
        $this->hapusFoto($foto);

        return response()->json(['message' => 'Destinasi berhasil dihapus.']);
    }

    // Simpan ke storage/app/public/destinasi (nama acak). Dibaca lewat public/storage (php artisan storage:link)
    private function simpanFoto(UploadedFile $file): string
    {
        return 'storage/'.$file->store('destinasi', 'public');
    }

    // Hapus file hasil upload saja. Foto bawaan (images/) tidak disentuh.
    private function hapusFoto(?string $path): void
    {
        if (! $path) {
            return;
        }
        if (str_starts_with($path, 'storage/')) {
            Storage::disk('public')->delete(Str::after($path, 'storage/'));
        } elseif (str_starts_with($path, 'uploads/')) {
            File::delete(public_path($path)); // upload dari panel admin web
        }
    }
}
