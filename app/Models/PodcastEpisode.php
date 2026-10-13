<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class PodcastEpisode extends Model {
    use HasFactory;
    protected $fillable = ['judul','deskripsi','file_audio','url_audio','durasi','cover_image','kategori','jumlah_play','published_at'];
    protected $casts = ['jumlah_play'=>'integer','published_at'=>'datetime'];
}