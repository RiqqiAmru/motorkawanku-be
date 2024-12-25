<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investasi extends Model
{
    protected $primaryKey = 'id_investasi';
    use HasFactory;
    protected $table = 'investasi';
    protected $fillable = [
        'tahun',
        'id_kawasan',
        'id_rtrw',
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
