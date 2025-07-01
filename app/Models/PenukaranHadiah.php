<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenukaranHadiah extends Model
{
    use HasFactory;

    protected $table = 'penukaran_hadiah';
    protected $fillable = [
        'nasabah_id',
        'hadiah_id',
        'jumlah_poin',
        'status',
        'keterangan',
        'tanggal_pengajuan',
        'tanggal_proses'
    ];

    protected $casts = [
        'tanggal_pengajuan' => 'datetime',
        'jumlah_poin' => 'integer'
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }

    public function hadiah()
    {
        return $this->belongsTo(Hadiah::class);
    }
}