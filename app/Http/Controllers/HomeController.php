<?php

namespace App\Http\Controllers;

use App\Data\DestinasiData;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Landing page
    public function index()
    {
        $unggulan = array_slice(DestinasiData::all(), 0, 4);

        return view('frontpage.landingpage', [
            'title' => 'Beranda',
            'unggulan' => $unggulan,
        ]);
    }

    // Daftar destinasi + pencarian & filter kategori
    public function destinasi(Request $request)
    {
        $q = strtolower(trim((string) $request->query('q', '')));
        $kategori = (int) $request->query('kategori', 0);

        $daftar = array_values(array_filter(DestinasiData::all(), function ($d) use ($q, $kategori) {
            $cocokKategori = $kategori === 0 || $d['category'] === $kategori;
            $cocokKata = $q === '' || str_contains(strtolower($d['name'].' '.$d['location'].' '.$d['category_name']), $q);
            return $cocokKategori && $cocokKata;
        }));

        return view('frontpage.destinasi', [
            'title' => 'Destinasi',
            'daftar' => $daftar,
            'kategori' => DestinasiData::kategori(),
            'q' => $request->query('q', ''),
            'kategoriDipilih' => $kategori,
        ]);
    }

    // Detail satu destinasi berdasarkan slug
    public function detail(string $slug)
    {
        $destinasi = DestinasiData::find($slug);
        abort_if($destinasi === null, 404);

        return view('frontpage.detail', [
            'title' => $destinasi['name'],
            'p' => $destinasi,
        ]);
    }

    public function promo()
    {
        return view('frontpage.promo', ['title' => 'Promo']);
    }

    // Keranjang & checkout masih statis (prototipe). Logika asli menyusul di modul berikutnya.
    public function keranjang()
    {
        $item = array_slice(DestinasiData::all(), 0, 2);

        return view('frontpage.keranjang', ['title' => 'Keranjang', 'item' => $item]);
    }

    public function checkout()
    {
        $item = array_slice(DestinasiData::all(), 0, 2);

        return view('frontpage.checkout', ['title' => 'Checkout', 'item' => $item]);
    }
}
