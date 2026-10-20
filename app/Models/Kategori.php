<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    public $primaryKey = 'id_kategori';

    protected $fillable = ['nama_kategori'];

    // Satu kategori memiliki banyak destinasi (One to Many)
    public function destinasis()
    {
        return $this->hasMany(Destinasi::class, 'id_kategori', 'id_kategori');
    }
}
