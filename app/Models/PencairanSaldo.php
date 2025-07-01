<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PencairanSaldo extends Model
{
    protected $table = 'pencairan_saldo'; // sesuaikan dengan nama tabel di DB kamu

    protected $fillable = [
    'nasabah_id',
    'metode_pencairan',
    'jumlah_pencairan',
    'status',
    'tanggal_pengajuan',
    'tanggal_proses',
    'keterangan',
    'no_rek'
];

protected $casts = [
    'tanggal_pengajuan' => 'datetime',
    'tanggal_proses' => 'datetime',
];

public function nasabah()
{
    return $this->belongsTo(Nasabah::class, 'nasabah_id');
}

public function metode()
{
    return $this->belongsTo(MetodePencairan::class, 'metode_pencairan_id');
}

}
