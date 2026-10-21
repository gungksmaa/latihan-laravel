<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DestinasiResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id_destinasi,
            'nama' => $this->nama,
            'slug' => $this->slug,
            'harga' => [
                'dewasa' => (int) $this->harga_dewasa,
                'anak' => (int) $this->harga_anak,
            ],
            'kuota' => (int) $this->kuota,
            'rating' => (int) $this->rating,
            'lokasi' => $this->lokasi,
            'jam_buka' => $this->jam_buka,
            'durasi' => $this->durasi,
            'deskripsi' => $this->deskripsi,
            'foto_url' => $this->foto ? url($this->foto) : null,
            'status' => $this->status === 'Y' ? 'aktif' : 'non-aktif',
            'kategori' => new KategoriResource($this->whenLoaded('kategori')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
