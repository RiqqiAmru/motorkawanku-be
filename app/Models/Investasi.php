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
        'idKriteria',
        'volume',
        'kegiatan',
        'locked'
    ];

    
}