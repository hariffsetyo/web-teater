<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Testimonial extends Model {
    use HasFactory;
    protected $fillable = ['nama','peran','isi','foto','featured'];
    protected $casts = ['featured'=>'boolean'];
}