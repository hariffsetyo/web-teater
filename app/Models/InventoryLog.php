<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class InventoryLog extends Model {
    use HasFactory;
    protected $fillable = ['inventory_item_id','dipinjam_oleh','jumlah_pinjam','tanggal_pinjam','tanggal_kembali_rencana','tanggal_kembali_aktual','status','catatan'];
    protected $casts = ['tanggal_pinjam'=>'date','tanggal_kembali_rencana'=>'date','tanggal_kembali_aktual'=>'date'];
    public function inventoryItem() { return $this->belongsTo(InventoryItem::class); }
}