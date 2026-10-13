<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
class Article extends Model {
    use HasFactory, HasSlug;
    protected $fillable = ['judul','slug','konten','thumbnail','kategori','status','views','published_at'];
    protected $casts = ['views'=>'integer','published_at'=>'datetime'];
    public function getSlugOptions(): SlugOptions {
        return SlugOptions::create()->generateSlugsFrom('judul')->saveSlugsTo('slug');
    }
    public function comments() { return $this->hasMany(Comment::class); }
    public function approvedComments() { return $this->hasMany(Comment::class)->where('status','approved'); }
}