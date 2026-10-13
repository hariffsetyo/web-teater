<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'judul'           => 'required|min:3|max:200',
            'deskripsi'       => 'nullable|max:3000',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'lokasi'          => 'nullable|max:200',
            'poster'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'tipe'            => 'required|in:latihan,pementasan,lomba',
            'status'          => 'required|in:draft,aktif,selesai,batal',
        ];
    }
    public function messages(): array {
        return [
            'judul.required'         => 'Judul agenda / lakon wajib diisi.',
            'tanggal_mulai.required' => 'Tanggal & waktu mulai wajib ditentukan.',
            'tipe.required'          => 'Pilih tipe agenda.',
            'status.required'        => 'Pilih status agenda.',
            'poster.image'           => 'Berkas poster harus berupa gambar.',
        ];
    }
}