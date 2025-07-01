<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengirimanPengepul extends Model
{
    use HasFactory;

    protected $table = 'pengiriman_pengepul';

    protected $fillable = [
        'kode_pengiriman',
        'tanggal_pengiriman',
        'pengepul_id'
    ];

    public function pengepul()
    {
        return $this->belongsTo(Pengepul::class, 'pengepul_id');
    }

    public function detailPengiriman()
    {
        return $this->hasMany(DetailPengiriman::class, 'pengiriman_id');
    }
}
