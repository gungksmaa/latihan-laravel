<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreDestinasiRequest extends FormRequest
{
    public function authorize()
    {
        // otorisasi ditangani middleware EnsureUserIsAdmin pada route
        return true;
    }

    public function rules()
    {
        return [
            'nama' => ['required', 'string', 'max:100'],
            'id_kategori' => ['required', 'integer', 'exists:kategoris,id_kategori'],
            'harga_dewasa' => ['required', 'numeric', 'min:0'],
            'harga_anak' => ['required', 'numeric', 'min:0'],
            'kuota' => ['required', 'integer', 'min:1'],
            'lokasi' => ['required', 'string', 'max:100'],
            'jam_buka' => ['nullable', 'string', 'max:100'],
            'durasi' => ['nullable', 'string', 'max:50'],
            'deskripsi' => ['nullable', 'string'],
            // mimes eksplisit: SVG tidak diizinkan (risiko XSS)
            'foto' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status' => ['sometimes', 'in:Y,N'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Kolom :attribute wajib diisi.',
            'exists' => 'Kategori tidak ditemukan.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
            'foto.mimes' => 'Foto harus berformat jpg, jpeg, png, atau webp.',
        ];
    }
}
