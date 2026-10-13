<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Gallery extends Model {
    use HasFactory;
    protected $fillable = ['judul','tipe','file_path','url_video','event_id','kategori','deskripsi'];
    public function event() { return $this->belongsTo(Event::class); }
}