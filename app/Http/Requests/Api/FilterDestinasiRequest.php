<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

// Validasi parameter query: ?search=&kategori=&harga_min=&harga_max=&sort=&order=&per_page=
class FilterDestinasiRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'search' => ['nullable', 'string', 'max:100'],
            'kategori' => ['nullable', 'integer', 'exists:kategoris,id_kategori'],
            'harga_min' => ['nullable', 'numeric', 'min:0'],
            'harga_max' => ['nullable', 'numeric', 'min:0', 'gte:harga_min'],
            'sort' => ['nullable', 'in:nama,harga_dewasa,rating,created_at'],
            'order' => ['nullable', 'in:asc,desc'],
            'per_page' => ['nullable', 'integer', 'between:1,50'],
        ];
    }
}
