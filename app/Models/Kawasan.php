<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kawasan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_kawasan';
    protected $table = 'kawasan';
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
        return DB::table('kawasan')
            ->select('kawasan', 'id_kawasan')
            ->get();
    }
}
