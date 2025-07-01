<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hadiah extends Model
{
    protected $table = 'hadiah';
    protected $fillable = [
        'nama_hadiah',
        'deskripsi',
        'jumlah_poin',
        'stok',
        'gambar',
        'status'
    ];
}