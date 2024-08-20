<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Latlang extends Model
{
    use HasFactory;
    protected $table = 'latlong';
    protected $fillable = ['kelurahan', 'type', 'coordinates', 'kodeRTRW'];
}
