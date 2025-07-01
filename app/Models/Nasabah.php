<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;

    protected $table = 'nasabah';

    protected $fillable = [
        'no_registrasi', 'nik', 'nama_lengkap', 'jenis_kelamin',
        'tempat_lahir', 'tanggal_lahir', 'no_hp', 'email',
        'username', 'password', 'alamat_lengkap', 'foto', 'status'
    ];

    public function saldo()
    {
        return $this->hasOne(Saldo::class, 'nasabah_id');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'nasabah_id');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'nasabah_id');
    }

    public function metodePencairan()
    {
        return $this->hasMany(MetodePencairan::class, 'nasabah_id');
    }

    public function pencairanSaldo()
    {
        return $this->hasMany(PencairanSaldo::class, 'nasabah_id');
    }

    public function poinNasabah()
    {
        return $this->hasOne(PoinNasabah::class, 'nasabah_id');
    }
}
