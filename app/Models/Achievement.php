<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Achievement extends Model {
    use HasFactory;
    protected $fillable = ['nama_lomba','tahun','tingkat','peringkat','foto','deskripsi'];
    protected $casts = ['tahun'=>'integer'];
}