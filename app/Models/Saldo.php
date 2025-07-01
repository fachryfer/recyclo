<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    use HasFactory;

    protected $table = 'saldo';

    protected $fillable = [
        'nasabah_id', 'saldo', 'tanggal_update'
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }

}
