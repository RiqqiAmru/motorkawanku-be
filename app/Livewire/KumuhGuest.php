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

        ($this->kumuhAwal) ? $this->kumuhAwal->{'tingkatKumuh'} = $this->hitungTingkatKumuh($this->kumuhAwal->tingkatKekumuhan) : '';
        ($this->kumuhAkhir) ? $this->kumuhAkhir->{'tingkatKumuh'} = $this->hitungTingkatKumuh($this->kumuhAkhir->tingkatKekumuhan) : '';
    }

    public function loadKumuhRT()
    {
        $this->kumuhAwal = KumuhRT::where(['tahun' => ($this->tahun - 1), 'kawasan' => $this->idKawasanTerpilih, 'rt' => $this->idRTTerpilih])->first();
        $this->kumuhAkhir = KumuhRT::where(['tahun' => $this->tahun, 'kawasan' => $this->idKawasanTerpilih, 'rt' => $this->idRTTerpilih])->first();

        ($this->kumuhAwal) ? $this->kumuhAwal->{'tingkatKumuh'} = $this->hitungTingkatKumuh($this->kumuhAwal->tingkatKekumuhan) : '';
        ($this->kumuhAkhir) ? $this->kumuhAkhir->{'tingkatKumuh'} = $this->hitungTingkatKumuh($this->kumuhAkhir->tingkatKekumuhan) : '';
    }

    public function hitungTingkatKumuh($tingkatKumuh)
    {
        switch ($tingkatKumuh) {
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

    public function render()
    {
        return view('livewire.kumuh-guest')->with(['kawasan' => Kawasan::umum()]);
    }
}
