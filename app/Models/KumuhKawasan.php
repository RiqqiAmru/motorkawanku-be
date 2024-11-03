<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KumuhKawasan extends Model
{
    use HasFactory;
    public $table = 'kumuh_kawasan';
    protected $fillable = [
        'kawasan',
        'tahun',
        '1av',
        '1ap',
        '1an',
        '1bv',
        '1bp',
        '1bn',
        '1cv',
        '1cp',
        '1cn',
        '1r',
        '2av',
        '2ap',
        '2an',
        '2bv',
        '2bp',
        '2bn',
        '2r',
        '3av',
        '3ap',
        '3an',
        '3bv',
        '3bp',
        '3bn',
        '3r',
        '4av',
        '4ap',
        '4an',
        '4bv',
        '4bp',
        '4bn',
        '4cv',
        '4cp',
        '4cn',
        '4r',
        '5av',
        '5ap',
        '5an',
        '5bv',
        '5bp',
        '5bn',
        '5r',
        '6av',
        '6ap',
        '6an',
        '6bv',
        '6bp',
        '6bn',
        '6r',
        '7av',
        '7ap',
        '7an',
        '7bv',
        '7bp',
        '7bn',
        '7r',
        'totalNilai',
        'tingkatKekumuhan',
        'ratarataKekumuhan',
        'kontribusiPenanganan',
        'updated_at'
    ];

    public function getWarnaAttribute()
    {
        switch ($this->tingkatKekumuhan) {
            case "TK":
                return ["TIDAK KUMUH", 'text-green-600 bg-green-50'];
            case "KR":
                return ["KUMUH RINGAN", 'text-yellow-600 bg-yellow-50'];
            case "KS":
                return ["KUMUH SEDANG", 'text-orange-600 bg-orange-50'];
            case "KB":
                return ["KUMUH BERAT", 'text-red-600 bg-red-50'];
        }
    }
}
