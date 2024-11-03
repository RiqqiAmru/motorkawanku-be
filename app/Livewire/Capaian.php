<?php

namespace App\Livewire;

use App\Models\Kawasan;
use App\Models\KumuhKawasan;
use App\Models\KumuhRT;
use App\Models\Rtrw;
use App\Models\SK24Kawasan;
use App\Models\SK24KumuhKawasan;
use App\Models\SK24KumuhRT;
use App\Models\SK24Rtrw;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
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
        $this->kawasan = SK24Kawasan::umum();
        $this->tahun = Carbon::now()->year;
    }

    public function updatedidKawasanTerpilih()
    {
        $this->reset('namaKawasan');
        $this->reset('daftarRT');
        $this->reset('kumuhKawasan');
        $this->reset('kumuhRT');

        $this->namaKawasan = SK24Kawasan::where('id', $this->idKawasanTerpilih)->get('kawasan')->first()?->toArray();
        $this->daftarRT = SK24Rtrw::where(['kawasan' => $this->idKawasanTerpilih])?->pluck('rtrw', 'id')->all();
        $this->kumuhKawasan = SK24KumuhKawasan::where(['kawasan' => $this->idKawasanTerpilih])->orderBy('tahun')->get(['tahun', 'totalNilai', 'tingkatKekumuhan']);

        $kumuhRT = SK24KumuhRT::where(['kawasan' => $this->idKawasanTerpilih])->get(['rt', 'tahun', 'totalNilai', 'tingkatKekumuhan']);
        $this->kumuhRT = $kumuhRT->groupby('rt')->all();
    }

    public function render()
    {

        return view('livewire.capaian');
    }
}
