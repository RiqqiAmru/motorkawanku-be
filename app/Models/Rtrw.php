<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rtrw extends Model
{
    protected $primaryKey = 'id_rtrw';
    use HasFactory;
    protected $table = 'rtrw';
    protected $fillable = [
        'id_kawasan',
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
