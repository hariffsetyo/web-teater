<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'judul'       => 'required|min:3|max:200',
            'tipe'        => 'required|in:foto,video',
            'event_id'    => 'nullable|exists:events,id',
            'kategori'    => 'nullable|max:100',
            'deskripsi'   => 'nullable|max:1000',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:8192',
            'url_video'   => 'nullable|url|max:255',
        ];
    }
    public function messages(): array {
        return [
            'judul.required' => 'Judul dokumentasi wajib diisi.',
            'tipe.required'  => 'Pilih tipe galeri (foto / video).',
            'url_video.url'  => 'Format URL video tidak valid.',
        ];
    }
}