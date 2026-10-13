<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
class Event extends Model {
    use HasFactory, HasSlug;
    protected $fillable = ['judul','slug','deskripsi','tanggal_mulai','tanggal_selesai','lokasi','poster','tipe','status'];
    protected $casts = ['tanggal_mulai'=>'datetime','tanggal_selesai'=>'datetime'];
    public function getSlugOptions(): SlugOptions {
        return SlugOptions::create()->generateSlugsFrom('judul')->saveSlugsTo('slug');
    }
    public function galleries() { return $this->hasMany(Gallery::class); }
    public function attendances() { return $this->hasMany(Attendance::class); }
    public function members() { return $this->belongsToMany(Member::class,'attendances'); }
    public function performances() { return $this->hasMany(Performance::class); }
}