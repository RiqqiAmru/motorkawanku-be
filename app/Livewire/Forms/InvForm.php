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

    public function edit($idInvestasi)
    {
        $investasi = ModelsInvestasi::find($idInvestasi);
        $this->idKriteria = $investasi->idkriteria;
        $this->volume = $investasi->volume;
        $this->kegiatan = $investasi->kegiatan;
        $this->sumberAnggaran = $investasi->sumberAnggaran;
        $this->anggaran = $investasi->anggaran;
    }
    public function update($idKawasanTerpilih, $idRTTerpilih, $idUser, $idInvestasi)
    {
        $this->validate();
        $investasi = ModelsInvestasi::find($idInvestasi);
        // Pastikan data ditemukan
        if ($investasi) {
            // Lakukan update
            $investasi->update([
                'id_kawasan' => $idKawasanTerpilih,
                'id_rtrw' => $idRTTerpilih,
                'idkriteria' => $this->idKriteria,
                'volume' => $this->volume,
                'kegiatan' => $this->kegiatan,
                'sumberAnggaran' => $this->sumberAnggaran,
                'anggaran' => $this->anggaran,
                'id_user' => $idUser
            ]);

            // Reset form setelah update
            $this->reset();
            session()->flash('success', 'Data investasi berhasil diperbarui.');
        } else {
            // Jika data tidak ditemukan
            session()->flash('error', 'Data tidak ditemukan untuk diupdate.');
        }
    }

    public function delete($param)
    {
        ModelsInvestasi::find($param, 'id_investasi')->delete();
        session()->flash('success', 'berhasil menghapus investasi.');
    }
}