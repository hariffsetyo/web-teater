<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'judul'        => 'required|min:3|max:200',
            'konten'       => 'required|min:10',
            'kategori'     => 'nullable|max:100',
            'thumbnail'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'status'       => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ];
    }
    public function messages(): array {
        return [
            'judul.required'  => 'Judul artikel wajib diisi.',
            'konten.required' => 'Isi konten artikel tidak boleh kosong.',
            'status.required' => 'Pilih status terbitan (draft / published).',
        ];
    }
}