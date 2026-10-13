<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class TicketReservation extends Model {
    use HasFactory;
    protected $fillable = ['performance_id','nama','email','no_hp','jumlah_tiket','kode_tiket','status'];
    protected static function booted(): void {
        static::creating(function ($model) {
            if (empty($model->kode_tiket)) {
                $model->kode_tiket = 'TKT-' . strtoupper(Str::random(8));
            }
        });
    }
    public function performance() { return $this->belongsTo(Performance::class); }
}