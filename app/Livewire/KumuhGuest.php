<?php

namespace App\Livewire;

use App\Models\Kawasan;
use App\Models\KumuhKawasan;
use App\Models\KumuhRT;
use App\Models\Latlang;
use App\Models\Rtrw;
use Carbon\Carbon;
use Livewire\Component;

class KumuhGuest extends Component
{
    public $idKawasanTerpilih;
    public $idRTTerpilih = null;
    public $daftarRT = null;
    public $header = null;
    public $tahun;
    public $kumuhAwal = null;
    public $kumuhAkhir = null;
    public $coordinate = ['main' => null, 'secondary' => null];
    public $show = 'kumuh';

    public function showTab($tab)
    {
        $this->show = $tab;
    }

    public function mount()
    {
        $this->tahun = Carbon::now()->year;
    }

    public function updatedidKawasanTerpilih($idKawasanTerpilih)
    {
        $this->reset('idRTTerpilih');
        $this->reset('daftarRT');
        $this->reset('kumuhAwal');
        $this->reset('kumuhAkhir');
        $this->header = Kawasan::find($idKawasanTerpilih);
        if ($this->header) {
            $this->loadKumuhKawasan();
        }
    }

    public function updatedidRTTerpilih($idRTTerpilih)
    {
        $this->reset('kumuhAwal');
        $this->reset('kumuhAkhir');
        $this->header = Rtrw::find($idRTTerpilih);
        if ($this->header) {
            $this->loadKumuhRT();
        }
    }

    public function updatedtahun()
    {
        if ($this->idRTTerpilih) {
            $this->loadKumuhRT();
        } else if ($this->idKawasanTerpilih) {
            $this->loadKumuhKawasan();
        }
    }

    public function loadKumuhKawasan()
    {
        $this->daftarRT = Rtrw::where('kawasan', $this->idKawasanTerpilih)->get(['id', 'rtrw']);
        $this->coordinate['main'] = Latlang::where('kelurahan', $this->header->kawasan)->first();
        $this->coordinate['secondary'] = Latlang::where('kelurahan', $this->header->wilayah)->first();
        $this->kumuhAwal = KumuhKawasan::where(['tahun' => ($this->tahun - 1), 'kawasan' => $this->idKawasanTerpilih])->first();
        $this->kumuhAkhir = KumuhKawasan::where(['tahun' => $this->tahun, 'kawasan' => $this->idKawasanTerpilih])->first();
    }

    public function loadKumuhRT()
    {
        $this->kumuhAwal = KumuhRT::where(['tahun' => ($this->tahun - 1), 'kawasan' => $this->idKawasanTerpilih, 'rt' => $this->idRTTerpilih])->first();
        $this->kumuhAkhir = KumuhRT::where(['tahun' => $this->tahun, 'kawasan' => $this->idKawasanTerpilih, 'rt' => $this->idRTTerpilih])->first();
    }

    public function render()
    {
        return view('livewire.kumuh-guest')->with(['kawasan' => Kawasan::umum()]);
    }
}
