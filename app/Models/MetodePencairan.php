<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePencairan extends Model
{
    use HasFactory;

    protected $table = 'metode_pencairan';

    protected $fillable = [
        'nasabah_id', 'nama_metode_pencairan', 'no_rek'
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'nasabah_id');
    }

}
