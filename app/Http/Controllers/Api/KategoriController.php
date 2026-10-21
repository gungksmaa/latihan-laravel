<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KategoriResource;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::withCount(['destinasis' => fn ($q) => $q->aktif()])->get();

        return KategoriResource::collection($kategoris);
    }
}
