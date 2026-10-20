<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinasi extends Model
{
    use HasFactory;

    // Primary key tidak standar (bukan "id")
    public $primaryKey = 'id_destinasi';

    // Field yang boleh diisi lewat create() dan update()
    protected $fillable = [
        'id_kategori', 'nama', 'slug', 'harga_dewasa', 'harga_anak', 'kuota', 'rating',
        'lokasi', 'jam_buka', 'durasi', 'deskripsi', 'foto', 'status',
    ];

    // Setiap destinasi termasuk dalam satu kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}
