<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $primaryKey = 'id_kota';
    use HasFactory;
    protected $table = 'kota';
    protected $fillable = ['kota', 'provinsi', 'SK'];
    public $timestamps = false;
}
