<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_pendaftaran',
        'nama',
        'email',
        'no_hp',
        'kelas',
        'divisi',
        'alasan_daftar',
        'motivasi',
        'file_audisi',
        'status',
        'catatan_admin',
    ];

    protected static function booted()
    {
        static::creating(function ($reg) {
            if (empty($reg->nomor_pendaftaran)) {
                $reg->nomor_pendaftaran = 'REG-' . date('Y') . '-' . strtoupper(Str::random(5));
            }
        });
    }

    public function getDivisiLabelAttribute(): string
    {
        return [
            'akting'        => 'Akting & Peran',
            'naskah'        => 'Penulisan Naskah',
            'tata_rias'     => 'Tata Rias & Busana',
            'tata_panggung' => 'Tata Panggung & Cahaya',
            'musik'         => 'Musik & Tata Suara',
            'humas'         => 'Humas & Dokumentasi',
        ][$this->divisi] ?? ucfirst(str_replace('_', ' ', $this->divisi ?? ''));
    }
}