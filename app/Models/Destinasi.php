<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    // Hanya destinasi berstatus aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'Y');
    }

    // Pencarian, penyaringan, dan pengurutan. $f sudah divalidasi oleh FilterDestinasiRequest.
    public function scopeFilter($query, array $f)
    {
        $query->when($f['search'] ?? null, function ($q, $kata) {
            $q->where(function ($w) use ($kata) {
                $w->where('nama', 'like', "%{$kata}%")
                  ->orWhere('lokasi', 'like', "%{$kata}%");
            });
        });

        $query->when($f['kategori'] ?? null, fn ($q, $id) => $q->where('id_kategori', $id));

        if (isset($f['harga_min'])) {
            $query->where('harga_dewasa', '>=', $f['harga_min']);
        }
        if (isset($f['harga_max'])) {
            $query->where('harga_dewasa', '<=', $f['harga_max']);
        }

        // kolom pengurutan dibatasi (whitelist) agar aman dari injeksi
        $kolom = in_array($f['sort'] ?? '', ['nama', 'harga_dewasa', 'rating', 'created_at'], true)
            ? $f['sort'] : 'id_destinasi';
        $arah = ($f['order'] ?? 'asc') === 'desc' ? 'desc' : 'asc';

        return $query->orderBy($kolom, $arah);
    }

    // Slug unik dari nama
    public static function slugUnik(string $nama): string
    {
        $asli = $slug = Str::slug($nama);
        $i = 2;
        while (static::where('slug', $slug)->exists()) {
            $slug = $asli.'-'.$i++;
        }

        return $slug;
    }
}
