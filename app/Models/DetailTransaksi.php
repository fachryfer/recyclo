<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';

    protected $fillable = [
        'transaksi_id', 'sampah_id', 'berat_kg', 'harga_per_kg', 'harga_total'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    public function sampah()
    {
        return $this->belongsTo(Sampah::class, 'sampah_id')->withTrashed();
    }
}
