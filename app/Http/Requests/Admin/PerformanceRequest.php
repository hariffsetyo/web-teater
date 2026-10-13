<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class PerformanceRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'event_id'         => 'required|exists:events,id',
            'judul_pementasan' => 'required|min:3|max:200',
            'sinopsis'         => 'nullable|max:2000',
            'kuota_kursi'      => 'required|integer|min:1|max:5000',
            'harga_tiket'      => 'nullable|numeric|min:0',
            'status'           => 'required|in:buka,tutup',
        ];
    }
    public function messages(): array {
        return [
            'event_id.required'         => 'Pilih agenda event terkait.',
            'judul_pementasan.required' => 'Judul lakon pementasan wajib diisi.',
            'kuota_kursi.required'      => 'Jumlah kuota kursi wajib ditentukan.',
            'status.required'           => 'Status loket tiket wajib dipilih.',
        ];
    }
}