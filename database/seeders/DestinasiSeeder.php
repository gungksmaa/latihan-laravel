<?php

namespace Database\Seeders;

use App\Data\DestinasiData;
use App\Models\Destinasi;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class DestinasiSeeder extends Seeder
{
    // Memindahkan data dummy (DestinasiData) ke database. Aman dijalankan berulang kali.
    public function run()
    {
        $idKategori = [];
        foreach (DestinasiData::kategori() as $id => $nama) {
            if ($id === 0) {
                continue; // 0 = "Semua Kategori" (hanya untuk filter)
            }
            $idKategori[$id] = Kategori::firstOrCreate(['nama_kategori' => $nama])->id_kategori;
        }

        foreach (DestinasiData::all() as $d) {
            Destinasi::updateOrCreate(['slug' => $d['slug']], [
                'id_kategori' => $idKategori[$d['category']],
                'nama' => $d['name'],
                'harga_dewasa' => $d['price'],
                'harga_anak' => $d['child_price'],
                'kuota' => $d['stock'],
                'rating' => $d['rating'],
                'lokasi' => $d['location'],
                'jam_buka' => $d['opening_hours'],
                'durasi' => $d['duration'],
                'deskripsi' => $d['description'],
                'foto' => 'images/'.$d['img'],
                'status' => 'Y',
            ]);
        }
    }
}
