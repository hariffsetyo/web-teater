<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Member extends Model {
    use HasFactory;
    protected $fillable = ['nama','foto','divisi','angkatan','kelas','no_hp','bio','status'];
    protected $casts = ['angkatan'=>'integer'];
    public function attendances() { return $this->hasMany(Attendance::class); }
    public function events() { return $this->belongsToMany(Event::class,'attendances'); }
    public function getDivisiLabelAttribute(): string {
        return match($this->divisi) {
            'akting'=>'Akting','naskah'=>'Penulisan Naskah',
            'tata_rias'=>'Tata Rias','tata_panggung'=>'Tata Panggung',
            'musik'=>'Musik','humas'=>'Humas & Dokumentasi',default=>$this->divisi,
        };
    }
}