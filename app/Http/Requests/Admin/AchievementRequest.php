<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class AchievementRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'nama_lomba' => 'required|min:3|max:200',
            'tahun'      => 'required|digits:4',
            'tingkat'    => 'required|max:50',
            'peringkat'  => 'required|max:50',
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'deskripsi'  => 'nullable|max:1000',
        ];
    }
    public function messages(): array {
        return [
            'nama_lomba.required' => 'Nama perlombaan / festival wajib diisi.',
            'tahun.required'      => 'Tahun pencapaian wajib diisi.',
            'tingkat.required'    => 'Tingkat kejuaraan wajib diisi.',
            'peringkat.required'  => 'Gelar / Peringkat juara wajib diisi.',
        ];
    }
}