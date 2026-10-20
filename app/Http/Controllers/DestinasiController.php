<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DestinasiController extends Controller
{
    // Pesan kesalahan validasi (bahasa Indonesia)
    private $messages = [
        'required' => 'Kolom :attribute harus lengkap',
        'numeric' => 'Kolom :attribute harus angka',
        'integer' => 'Kolom :attribute harus bilangan bulat',
        'mimes' => 'Foto harus berformat png, jpg, atau jpeg',
        'max' => 'Kolom :attribute melebihi batas ukuran/panjang',
        'exists' => 'Kategori tidak valid',
    ];

    // READ: daftar + pencarian + filter kategori + pagination
    public function index(Request $request)
    {
        $title = 'Daftar Destinasi';

        $destinasis = Destinasi::with('kategori');

        // kata kunci pencarian (?s=...)
        if ($request->filled('s')) {
            $destinasis->where('nama', 'like', '%'.$request->query('s').'%');
        }
        // filter kategori (?id_kategori=...)
        if ($request->filled('id_kategori')) {
            $destinasis->where('id_kategori', $request->query('id_kategori'));
        }

        // eksekusi query, 5 data per halaman
        $destinasis = $destinasis->paginate(5);
        $kategoris = Kategori::all();

        return view('admin.daftardestinasi', compact('title', 'destinasis', 'kategoris'));
    }

    // Daftar destinasi berdasarkan satu kategori (memanfaatkan hasMany)
    public function kategori($id)
    {
        $kategori = Kategori::findOrFail($id);
        $title = 'Kategori '.$kategori->nama_kategori;
        // destinasis() (dengan kurung) mengembalikan query builder, jadi bisa paginate
        $destinasis = $kategori->destinasis()->with('kategori')->paginate(5);
        $kategoris = Kategori::all();

        return view('admin.daftardestinasi', compact('title', 'destinasis', 'kategoris'));
    }

    // Form tambah data
    public function create()
    {
        $title = 'Input Destinasi';
        $kategoris = Kategori::all();

        return view('admin.inputdestinasi', compact('title', 'kategoris'));
    }

    // CREATE: simpan data baru
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama' => 'required|max:100',
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'harga_dewasa' => 'required|numeric|min:0',
            'harga_anak' => 'required|numeric|min:0',
            'kuota' => 'required|integer|min:1',
            'lokasi' => 'required|max:100',
            'jam_buka' => 'nullable|max:100',
            'durasi' => 'nullable|max:50',
            'deskripsi' => 'nullable',
            'foto' => 'required|mimes:png,jpg,jpeg|max:1024',
            'status' => 'required|in:Y,N',
        ], $this->messages);

        $validasi['foto'] = $this->simpanFoto($request->file('foto'));
        $validasi['slug'] = $this->buatSlug($validasi['nama']);

        Destinasi::create($validasi);

        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi berhasil ditambahkan.');
    }

    // Form edit (memakai view yang sama dengan input)
    public function edit($id)
    {
        $destinasi = Destinasi::findOrFail($id);
        $title = 'Edit Data '.$destinasi->nama;
        $kategoris = Kategori::all();

        return view('admin.inputdestinasi', compact('title', 'kategoris', 'destinasi'));
    }

    // UPDATE: simpan perubahan
    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'nama' => 'required|max:100',
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'harga_dewasa' => 'required|numeric|min:0',
            'harga_anak' => 'required|numeric|min:0',
            'kuota' => 'required|integer|min:1',
            'lokasi' => 'required|max:100',
            'jam_buka' => 'nullable|max:100',
            'durasi' => 'nullable|max:50',
            'deskripsi' => 'nullable',
            'foto' => 'nullable|mimes:png,jpg,jpeg|max:1024',
            'status' => 'required|in:Y,N',
        ], $this->messages);

        $destinasi = Destinasi::findOrFail($id);

        // foto hanya diganti jika ada file baru
        if ($request->hasFile('foto')) {
            $this->hapusFoto($destinasi->foto);
            $validasi['foto'] = $this->simpanFoto($request->file('foto'));
        } else {
            unset($validasi['foto']);
        }

        $destinasi->update($validasi);

        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi berhasil diperbarui.');
    }

    // DELETE
    public function destroy($id)
    {
        $destinasi = Destinasi::findOrFail($id);
        $this->hapusFoto($destinasi->foto);
        $destinasi->delete();

        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi berhasil dihapus.');
    }

    // Upload ke folder public/uploads/destinasi, mengembalikan path untuk disimpan di kolom foto
    private function simpanFoto($file): string
    {
        $nama = time().'-'.Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/destinasi'), $nama);

        return 'uploads/destinasi/'.$nama;
    }

    // Hapus file hasil upload. Foto bawaan (folder images/) tidak dihapus.
    private function hapusFoto(?string $path): void
    {
        if ($path && str_starts_with($path, 'uploads/')) {
            File::delete(public_path($path));
        }
    }

    private function buatSlug(string $nama): string
    {
        $asli = $slug = Str::slug($nama);
        $i = 2;
        while (Destinasi::where('slug', $slug)->exists()) {
            $slug = $asli.'-'.$i++;
        }

        return $slug;
    }
}
