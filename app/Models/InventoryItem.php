<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class InventoryItem extends Model {
    use HasFactory;
    protected $fillable = ['nama_barang','kategori','kondisi','jumlah_stok','foto','lokasi_simpan','deskripsi'];
    protected $casts = ['jumlah_stok'=>'integer'];
    public function logs() { return $this->hasMany(InventoryLog::class); }
    public function activeLoans() { return $this->hasMany(InventoryLog::class)->where('status','dipinjam'); }
}