<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Landing page
    public function index()
    {
        $unggulan = Destinasi::with('kategori')->where('status', 'Y')->take(4)->get();

        return view('frontpage.landingpage', [
            'title' => 'Beranda',
            'unggulan' => $unggulan,
        ]);
    }

    // Daftar destinasi + pencarian & filter kategori
    public function destinasi(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $kategoriDipilih = (int) $request->query('kategori', 0);

        $query = Destinasi::with('kategori')->where('status', 'Y');

        if ($kategoriDipilih !== 0) {
            $query->where('id_kategori', $kategoriDipilih);
        }
        if ($q !== '') {
            $query->where(function ($w) use ($q) {
                $w->where('nama', 'like', "%$q%")
                  ->orWhere('lokasi', 'like', "%$q%")
                  ->orWhereHas('kategori', function ($k) use ($q) {
                      $k->where('nama_kategori', 'like', "%$q%");
                  });
            });
        }

        return view('frontpage.destinasi', [
            'title' => 'Destinasi',
            'daftar' => $query->get(),
            'kategori' => [0 => 'Semua Kategori'] + Kategori::pluck('nama_kategori', 'id_kategori')->toArray(),
            'q' => $q,
            'kategoriDipilih' => $kategoriDipilih,
        ]);
    }

    // Detail satu destinasi berdasarkan slug
    public function detail(string $slug)
    {
        $destinasi = Destinasi::with('kategori')->where('slug', $slug)->where('status', 'Y')->firstOrFail();

        return view('frontpage.detail', [
            'title' => $destinasi->nama,
            'p' => $destinasi,
        ]);
    }

    public function promo()
    {
        return view('frontpage.promo', ['title' => 'Promo']);
    }

    // Keranjang & checkout masih statis (prototipe)
    public function keranjang()
    {
        $item = Destinasi::where('status', 'Y')->take(2)->get();

        return view('frontpage.keranjang', ['title' => 'Keranjang', 'item' => $item]);
    }

    public function checkout()
    {
        $item = Destinasi::where('status', 'Y')->take(2)->get();

        return view('frontpage.checkout', ['title' => 'Checkout', 'item' => $item]);
    }
}
