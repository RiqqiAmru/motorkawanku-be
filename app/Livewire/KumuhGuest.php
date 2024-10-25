<?php

namespace App\Livewire;

use App\Models\Investasi;
use App\Models\Kawasan;
use App\Models\KumuhKawasan;
use App\Models\KumuhRT;
use App\Models\Latlang;
use App\Models\Rtrw;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Number;

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
    public $coordinate = null;
    public $coordinate2 = null;
    public $show = 'kumuh';
    public $investasi = null;
    public $description = null;
    public $description2 = null;



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
        $this->reset('investasi');
        $this->reset('coordinate');
        $this->header = Kawasan::find($idKawasanTerpilih);
        if ($this->header) {
            $this->loadKumuhKawasan();
        }
    }

    public function updatedidRTTerpilih($idRTTerpilih)
    {
        $this->reset('kumuhAwal');
        $this->reset('kumuhAkhir');
        $this->reset('investasi');
        $this->reset('coordinate2');
        if ($idRTTerpilih == 0) {
            $this->updatedidKawasanTerpilih($this->idKawasanTerpilih);
        } else {
            $this->header = Rtrw::find($idRTTerpilih);
            if ($this->header) {
                $this->loadKumuhRT();
            }
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
        $this->coordinate = Latlang::where('kelurahan', $this->header->kawasan)->first()->toArray();
        $this->kumuhAwal = KumuhKawasan::where(['tahun' => ($this->tahun - 1), 'kawasan' => $this->idKawasanTerpilih])->first();
        $this->kumuhAkhir = KumuhKawasan::where(['tahun' => $this->tahun, 'kawasan' => $this->idKawasanTerpilih])->first();

        $investasi = Investasi::where(['tahun' => $this->tahun, 'idKawasan' => $this->idKawasanTerpilih])->get()->toArray();
        $this->investasi = Arr::map($investasi, function ($value) {
            return [
                ...$value,
                'anggaran' => Number::currency(intval($value['anggaran']), 'IDR', 'id')
            ];
        });
        $kumuh = $this->kumuhAkhir?->toArray() ? $this->kumuhAkhir?->toArray() : $this->kumuhAwal?->toArray();
        $this->description = $this->coordinateDescription($kumuh);

        $this->dispatch('updated-investasi');
    }

    public function loadKumuhRT()
    {
        $this->kumuhAwal = KumuhRT::where(['tahun' => ($this->tahun - 1), 'kawasan' => $this->idKawasanTerpilih, 'rt' => $this->idRTTerpilih])->first();
        $this->kumuhAkhir = KumuhRT::where(['tahun' => $this->tahun, 'kawasan' => $this->idKawasanTerpilih, 'rt' => $this->idRTTerpilih])->first();
        $investasi = Investasi::where(['tahun' => $this->tahun, 'idKawasan' => $this->idKawasanTerpilih, 'idRTRW' => $this->idRTTerpilih])->get()->toArray();
        $this->investasi = Arr::map($investasi, function ($value) {
            return [
                ...$value,
                'anggaran' => Number::currency(intval($value['anggaran']), 'IDR', 'id')
            ];
        });

        $kelurahan = Kawasan::find($this->idKawasanTerpilih);
        $this->coordinate2 = Latlang::where(['kelurahan' => $kelurahan->kawasan, 'kodeRTRW' => $this->header->rtrw])->first()?->toArray();
        $kumuh = $this->kumuhAkhir?->toArray() ? $this->kumuhAkhir?->toArray() : $this->kumuhAwal?->toArray();
        $this->description2 = $this->coordinateDescription($kumuh);

        $this->dispatch('updated-investasi');
    }

    public function coordinateDescription($kumuh)
    {
        switch ($kumuh['tingkatKekumuhan']) {
            case 'KB':
                return ['color' => 'red', 'description' => 'KUMUH BERAT'];
            case 'KS':
                return ['color' => 'ffbb05', 'description' => 'KUMUH SEDANG'];
            case 'KR':
                return ['color' => 'yellow', 'description' => 'KUMUH RINGAN'];
            case 'TK':
                return ['color' => 'green', 'description' => 'TIDAK KUMUH '];
            default:
                return ['color' => 'gray', 'description' => ''];
        }
    }
    public function render()
    {
        return view('livewire.kumuh-guest')->with(['kawasan' => Kawasan::umum()]);
    }
}