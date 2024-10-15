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

    public $kriteria = [
        [
            'aspek' => "1. Kondisi Bangunan Gedung",
            'kriteria' => "a. Ketidakteraturan Bangunan",
            'kriteriaSpan' => 1,
            'aspekSpan' => 3,
            'satuan' => "Unit",
            'id' => "1a",
        ],
        [
            'aspek' => "1",
            'satuan' => "Ha",
            'kriteriaSpan' => 1,
            'kriteria' => "b. Kepadatan Bangunan",
            'id' => "1b",
        ],
        [
            'id' => "1c",
            'aspek' => "1",
            'kriteriaSpan' => 1,
            'satuan' => "Unit",
            'kriteria' => "c. Ketidaksesuaian Dengan Persy Teknis Bangunan",
        ],
        [
            'aspek' => "2. Kondisi Jalan Lingkungan",
            'kriteria' => "a. Cakupan Pelayanan Jalan Lingkungan",
            'kriteriaSpan' => 1,
            'satuan' => "Meter",
            'aspekSpan' => 2,
            'id' => "2a",
        ],
        [

            'kriteriaSpan' => 1,
            'aspek' => "2",
            'kriteria' => "b. Kualitas Permukaan Jalan Lingkungan",
            'satuan' => "Meter",
            'id' => "2b",
        ],
        [

            'kriteriaSpan' => 1,
            'aspek' => "3. Kondisi Penyediaan Air Minum",
            'satuan' => "KK",
            'kriteria' => "a. Ketersediaan Akses Aman Air Minum",
            'aspekSpan' => 2,
            'id' => "3a",
        ],
        [

            'kriteriaSpan' => 1,
            'aspek' => "3",
            'satuan' => "KK",
            'kriteria' => "b. Tidak Terpenuhinya Kebutuhan Air Minum",
            'id' => "3b",
        ],
        [

            'kriteriaSpan' => 1,
            'satuan' => "Ha",
            'aspek' => "4. Kondisi Drainase Lingkungan",
            'kriteria' => "a. Ketidakmampuan Mengalirkan Limpasan Air",
            'aspekSpan' => 3,
            'id' => "4a",
        ],
        [

            'kriteriaSpan' => 1,
            'aspek' => "4",
            'satuan' => "Meter",
            'kriteria' => "b. Ketidaktersediaan Drainase",
            'id' => "4b",
        ],
        [

            'kriteriaSpan' => 1,
            'aspek' => "4",
            'satuan' => "Meter",
            'kriteria' => "c. Kualitas Konstruksi Drainase",
            'id' => "4c",
        ],
        [

            'kriteriaSpan' => 1,
            'satuan' => "KK",
            'aspek' => "5. Kondisi Pengelolaan Air Limbah",
            'kriteria' => "a. Sistem Pengelolaan Air Limbah Tidak Sesuai Standar Teknis",
            'aspekSpan' => 2,
            'id' => "5a",
        ],
        [

            'kriteriaSpan' => 1,
            'satuan' => "KK",
            'aspek' => "5",
            'kriteria' =>
            "b. Prasarana Dan Sarana Pengelolaan Air Limbah Tidak Sesuai Dengan Persyaratan Teknis",
            'id' => "5b",
        ],
        [

            'aspek' => "6. Kondisi Pengelolaan Persampahan",
            'satuan' => "KK",
            'kriteriaSpan' => 1,
            'aspekSpan' => 2,
            'kriteria' =>
            "a. Prasarana Dan Sarana Persampahan Tidak Sesuai Dengan Persyaratan Teknis",
            'id' => "6a",
        ],
        [

            'kriteriaSpan' => 1,
            'satuan' => "KK",
            'aspek' => "6",
            'kriteria' =>
            "b. Sistem Pengelolaan Persampahan Yang Tidak Sesuai Standar Teknis",
            'id' => "6b",
        ],
        [

            'kriteriaSpan' => 1,
            'aspekSpan' => 2,
            'satuan' => "Unit",
            'aspek' => "7. Kondisi Proteksi Kebakaran",
            'kriteria' => "a. Ketidaktersediaan Prasarana Proteksi Kebakaran",
            'id' => "7a",
        ],
        [

            'kriteriaSpan' => 1,
            'satuan' => "Unit",
            'aspek' => "7",
            'kriteria' => "b. Ketidaktersediaan Sarana Proteksi Kebakaran",
            'id' => "7b",
        ]
    ];
}
