<?php

namespace App\Livewire;

use App\Models\Kawasan;
use App\Models\KumuhKawasan;
use App\Models\KumuhRT;
use App\Models\Rtrw;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Livewire\Attributes\Computed;

class Capaian extends Component
{
    public $kawasan = null;
    public $idKawasanTerpilih = null;
    public $tahun = null;
    public $namaKawasan = null;
    public $daftarRT = null;
    public $kumuhKawasan = null;

    public array $kumuhRT;

    public function mount()
    {
        $this->kawasan = Kawasan::umum();
        $this->tahun = Carbon::now()->year;
    }

    public function updatedidKawasanTerpilih()
    {
        $this->reset('namaKawasan');
        $this->reset('daftarRT');
        $this->reset('kumuhKawasan');
        $this->reset('kumuhRT');

        $this->namaKawasan = Kawasan::where('id', $this->idKawasanTerpilih)->get('kawasan')->first()?->toArray();
        $this->daftarRT = Rtrw::where(['kawasan' => $this->idKawasanTerpilih])?->pluck('rtrw', 'id')->all();
        $this->kumuhKawasan = KumuhKawasan::where(['kawasan' => $this->idKawasanTerpilih])->orderBy('tahun')->get(['tahun', 'totalNilai', 'tingkatKekumuhan']);

        $kumuhRT = KumuhRT::where(['kawasan' => $this->idKawasanTerpilih])->get(['rt', 'tahun', 'totalNilai', 'tingkatKekumuhan']);
        $this->kumuhRT = $kumuhRT->groupby('rt')->all();
    }

    public function render()
    {

        return view('livewire.capaian');
    }
}