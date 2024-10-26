<?php

namespace App\Livewire\Forms;

use App\Livewire\Investasi;
use App\Models\Investasi as ModelsInvestasi;
use Livewire\Attributes\Validate;
use Livewire\Form;

class InvForm extends Form
{
    #[Validate('required')]
    public $kegiatan = '';
    #[Validate('required')]
    public $sumberAnggaran = '';
    #[Validate('required')]
    public $volume = '';
    #[Validate('required')]
    public $anggaran = '';

    public $idKriteria = "";

    public function store($tahun, $idKawasanTerpilih, $idRTTerpilih, $idUser)
    {
        $this->validate();

        ModelsInvestasi::create(
            [
                'tahun' => $tahun,
                'idKawasan' => $idKawasanTerpilih,
                'idRTRW' => $idRTTerpilih,
                'idkriteria' => $this->idKriteria,
                'volume' => $this->volume,
                'kegiatan' => $this->kegiatan,
                'sumberAnggaran' => $this->sumberAnggaran,
                'anggaran' => $this->anggaran,
                'id_user' => $idUser
            ]
        );
        $this->reset();
    }
}