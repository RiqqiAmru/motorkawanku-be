<?php

namespace App\Livewire\Forms;

use App\Livewire\Investasi;
use App\Models\Investasi as ModelsInvestasi;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Symfony\Component\CssSelector\Node\FunctionNode;

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
                'id_kawasan' => $idKawasanTerpilih,
                'id_rtrw' => $idRTTerpilih,
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

    public function delete($param)
    {

        ModelsInvestasi::find($param, 'id_investasi')->delete();
        session()->flash('success', 'berhasil menghapus investasi.');
    }
}
