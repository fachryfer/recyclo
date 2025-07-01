<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikel';

    protected $fillable = [
        'judul_postingan', 'isi_postingan', 'thumbnail'
    ];

    public function media()
    {
        return $this->hasMany(MediaArtikel::class, 'artikel_id');
    }
}
