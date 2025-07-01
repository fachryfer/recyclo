<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AplikasiAndroid extends Model
{
    use HasFactory;

    protected $table = 'aplikasi_android';

    protected $fillable = [
        'versi_aplikasi',
        'nama_file',
        'ukuran_file',
        'url_apk',
        'keterangan'
    ];
}
