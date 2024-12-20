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
    public $luasVerifikasiyangSudahBerkurang = 0;
    public $test = '';

    public array $kumuhRT;

    public function mount()
    {
        $this->kawasan = SK24Kawasan::umum();
        $this->tahun = Carbon::now()->year;
        $this->test = DB::table('sk24_kumuh_rt')
            ->join('sk24_rtrw', 'sk24_kumuh_rt.rt', '=', 'sk24_rtrw.id')
            ->join('sk24_kawasan', 'sk24_kumuh_rt.kawasan', '=', 'sk24_kawasan.id')
            ->select(['sk24_kawasan.kawasan', 'sk24_kumuh_rt.totalNilai', 'sk24_rtrw.rtrw'])
            ->get()->toArray();
    }

    public function updatedidKawasanTerpilih()
    {
        $this->reset('namaKawasan');
        $this->reset('daftarRT');
        $this->reset('kumuhKawasan');
        $this->reset('kumuhRT');

        $this->namaKawasan = SK24Kawasan::where('id', $this->idKawasanTerpilih)->get('kawasan')->first()?->toArray();
        $this->daftarRT = SK24Rtrw::where(['kawasan' => $this->idKawasanTerpilih])?->pluck('rtrw', 'id')->all();
        $this->kumuhKawasan = SK24KumuhKawasan::join('kawasan', 'kawasan.id', '=', 'sk24_kumuh_kawasan.kawasan')
            ->where('sk24_kumuh_kawasan.kawasan', $this->idKawasanTerpilih)
            ->orderBy('sk24_kumuh_kawasan.tahun')
            ->get(['sk24_kumuh_kawasan.tahun', 'sk24_kumuh_kawasan.totalNilai', 'sk24_kumuh_kawasan.tingkatKekumuhan', 'sk24_kumuh_kawasan.tahun', 'kawasan.luasVerifikasi', 'kawasan.id']);



        $kumuhRT = SK24KumuhRT::join('rtrw', 'rtrw.id', '=', 'sk24_kumuh_rt.rt')
            ->where('sk24_kumuh_rt.kawasan', $this->idKawasanTerpilih)
            ->get(['sk24_kumuh_rt.rt', 'sk24_kumuh_rt.tahun', 'sk24_kumuh_rt.totalNilai', 'sk24_kumuh_rt.tingkatKekumuhan', 'rtrw.luasVerifikasi']);

        $this->kumuhRT = $kumuhRT->groupby('rt')->all();

        // Initialize variables to store total luasVerifikasi for kawasan and for 'Tidak Kumuh'


        // Loop through the results to adjust luasVerifikasi based on tingkatKekumuhan
        $this->luasVerifikasiyangSudahBerkurang = SK24Kawasan::where('id', $this->idKawasanTerpilih)->get('luasVerifikasi')->first()?->luasVerifikasi;
        $kumuhRT = SK24KumuhRT::join('rtrw', 'rtrw.id', '=', 'sk24_kumuh_rt.rt')
            ->where('sk24_kumuh_rt.kawasan', $this->idKawasanTerpilih)
            ->where('sk24_kumuh_rt.tahun', Carbon::now()->year)
            ->get(['sk24_kumuh_rt.rt', 'sk24_kumuh_rt.tahun', 'sk24_kumuh_rt.totalNilai', 'sk24_kumuh_rt.tingkatKekumuhan', 'rtrw.luasVerifikasi']);
        foreach ($kumuhRT as $record) {
            // If tingkatKekumuhan is 'Tidak Kumuh', set luasVerifikasi to 0 and add to total for 'Tidak Kumuh'
            if ($record->tingkatKekumuhan == 'TK') {
                $this->luasVerifikasiyangSudahBerkurang -= $record->luasVerifikasi;
            }
        }
    }

    public function render()
    {

        return view('livewire.capaian');
    }
}