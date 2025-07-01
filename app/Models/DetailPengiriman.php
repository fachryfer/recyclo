<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengiriman extends Model
{
    use HasFactory;

    protected $table = 'detail_pengiriman';

    protected $fillable = [
        'pengiriman_id', 'sampah_id', 'berat_kg', 'harga_per_kg', 'harga_total'
    ];

    public function pengiriman()
    {
        return $this->belongsTo(PengirimanPengepul::class, 'pengiriman_id');
    }

    public function sampah()
    {
        return $this->belongsTo(Sampah::class, 'sampah_id');
    }
}
