<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = [
        'kode_transaksi',
        'nasabah_id',
        'petugas_id',
        'tanggal_transaksi'
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class);
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class);
    }

    public function getTotalTransaksiAttribute()
    {
        return $this->detailTransaksi()->sum('harga_total');
    }

    // Menambahkan method untuk menghitung poin
    public function hitungPoin()
    {
        $totalBerat = $this->detailTransaksi->sum('berat_kg');
        // Contoh perhitungan: 1 kg = 10 poin
        $poin = $totalBerat * 10;
        
        // Update poin nasabah
        $poinNasabah = PoinNasabah::firstOrCreate(
            ['nasabah_id' => $this->nasabah_id],
            ['jumlah_poin' => 0]
        );
        
        $poinNasabah->jumlah_poin += $poin;
        $poinNasabah->tanggal_update = now();
        $poinNasabah->save();
        
        return $poin;
    }
}