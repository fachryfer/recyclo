<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaArtikel extends Model
{
    use HasFactory;

    protected $table = 'media_artikel';

    protected $fillable = [
        'artikel_id', 'file_gambar'
    ];

    public function artikel()
    {
        return $this->belongsTo(Artikel::class, 'artikel_id');
    }

}
