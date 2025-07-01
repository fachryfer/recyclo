<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Petugas extends Authenticatable
{
    use HasFactory;

    protected $table = 'petugas';

    protected $fillable = [
        'nama', 'email', 'username', 'password', 'role'
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'petugas_id');
    }

}
