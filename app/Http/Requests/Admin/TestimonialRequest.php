<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'nama'     => 'required|min:3|max:100',
            'peran'    => 'nullable|max:100',
            'isi'      => 'required|min:5|max:1000',
            'featured' => 'boolean',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ];
    }
    public function messages(): array {
        return [
            'nama.required' => 'Nama pemberi testimoni wajib diisi.',
            'isi.required'  => 'Isi testimoni tidak boleh kosong.',
        ];
    }
}