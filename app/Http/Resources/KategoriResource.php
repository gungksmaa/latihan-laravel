<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KategoriResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id_kategori,
            'nama' => $this->nama_kategori,
            'jumlah_destinasi' => $this->whenCounted('destinasis'),
        ];
    }
}
