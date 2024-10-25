<?php

namespace App\Livewire\Forms;

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

    public function store($tahun)
    {
        dump($this->kegiatan, $this->sumberAnggaran, $this->volume, $this->anggaran, $tahun);
    }
}
