<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'nama'     => 'required|min:3|max:100',
            'divisi'   => 'required|in:akting,naskah,tata_rias,tata_panggung,musik,humas',
            'angkatan' => 'required|digits:4',
            'kelas'    => 'required|max:20',
            'no_hp'    => 'nullable|max:20',
            'bio'      => 'nullable|max:1000',
            'status'   => 'required|in:aktif,alumni',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ];
    }
    public function messages(): array {
        return [
            'nama.required'     => 'Nama anggota wajib diisi.',
            'divisi.required'   => 'Pilih salah satu divisi panggung.',
            'angkatan.required' => 'Tahun angkatan wajib diisi (contoh: 2025).',
            'kelas.required'    => 'Kelas / Jurusan wajib diisi.',
            'status.required'   => 'Status keanggotaan wajib dipilih.',
            'foto.image'        => 'Berkas harus berupa gambar.',
            'foto.max'          => 'Ukuran foto maksimal 5MB.',
        ];
    }
}