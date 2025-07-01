<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengepul extends Model
{
    use HasFactory;

    protected $table = 'pengepul';

    protected $fillable = [
        'nama', 'alamat', 'kontak'
    ];

    public function pengiriman()
    {
        return $this->hasMany(PengirimanPengepul::class, 'pengepul_id');
    }

}
