<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoinNasabah extends Model
{
    protected $table = 'poin_nasabah';
    protected $fillable = ['nasabah_id', 'jumlah_poin', 'tanggal_update'];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }
}
