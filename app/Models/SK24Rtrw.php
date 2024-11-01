<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SK24Rtrw extends Model
{
    use HasFactory;
    protected $table = 'sk24_rtrw';
    protected $fillable = [
        'kawasan',
        'rtrw',
        'luasFlag',
        'luasVerifikasi',
        'jumlahBangunan',
        'jumlahPenduduk',
        'jumlahKK',
        'panjangJalanIdeal',
        'panjangDrainaseIdeal'
    ];
    public $timestamps = false;
}
