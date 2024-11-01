<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SK24Kawasan extends Model
{
    use HasFactory;
    protected $table = 'sk24_kawasan';
    protected $fillable = [
        'kawasan',
        'wilayah',
        'rt-rw',
        'luasFlag',
        'luasVerifikasi',
        'jumlahBangunan',
        'jumlahPenduduk',
        'jumlahKK',
        'panjangJalanIdeal',
        'panjangDrainaseIdeal'
    ];
    public $timestamps = false;

    public static function umum()
    {
        return DB::table('sk24_kawasan')
            ->select('kawasan', 'id')
            ->get();
    }
}
