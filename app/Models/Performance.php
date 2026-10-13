<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Performance extends Model {
    use HasFactory;
    protected $fillable = ['event_id','judul_pementasan','sinopsis','kuota_kursi','harga_tiket','status'];
    protected $casts = ['kuota_kursi'=>'integer','harga_tiket'=>'decimal:2'];
    public function event() { return $this->belongsTo(Event::class); }
    public function ticketReservations() { return $this->hasMany(TicketReservation::class); }
    public function confirmedReservations() { return $this->hasMany(TicketReservation::class)->whereIn('status',['confirmed','hadir']); }
    public function getTiketTerjualAttribute(): int { return $this->confirmedReservations()->sum('jumlah_tiket'); }
    public function getSisaKursiAttribute(): int { return max(0, $this->kuota_kursi - $this->tiket_terjual); }
}