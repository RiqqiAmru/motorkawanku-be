<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investasi extends Model
{
    use HasFactory;
    protected $table = 'investasi';
    protected $fillable = [
        'tahun',
        'idKawasan',
        'idRTRW',
        'idkriteria',
        'volume',
        'kegiatan',
        'locked',
        'ket',
        'id_user',
        'sumberAnggaran',
        'anggaran'
    ];

    // editing 0, lock=1

}