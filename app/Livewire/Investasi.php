<?php

namespace App\Livewire;

use App\Livewire\Forms\InvForm;
use App\Models\Kawasan;
use App\Models\Rtrw;
use App\Models\Investasi as InvestasiModel;
use Illuminate\Support\Arr;
use Illuminate\Support\Number;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Investasi extends Component
{
    public $user = null;
    public $kawasan = null;
    public $idKawasanTerpilih = null;
    public $idRTTerpilih = null;
    public $rt = null;
    public $tahun = 2024;
    public $investasi = null;

    public InvForm $form;

    public function save()
    {
        $this->form->store($this->tahun);
    }

    public function updatedidKawasanTerpilih()
    {
        $this->reset('rt');
        $this->reset('investasi');
        $this->rt = Rtrw::where(['kawasan' => $this->idKawasanTerpilih])->get(['id', 'rtrw'])->toArray();
        $investasi = InvestasiModel::where(['tahun' => $this->tahun, 'idKawasan' => $this->idKawasanTerpilih])->get()->toArray();
        $this->investasi = Arr::map($investasi, function ($value) {
            return [
                ...$value,
                'anggaran' => Number::currency(intval($value['anggaran']), 'IDR', 'id')
            ];
        });
        $this->dispatch('updated-investasi');
    }

    public function updatedidRTTerpilih()
    {
        $this->reset('investasi');
        if ($this->idRTTerpilih == 0) {
            $this->updatedidKawasanTerpilih();
        } else {
            $investasi = InvestasiModel::where(['tahun' => $this->tahun, 'idKawasan' => $this->idKawasanTerpilih, 'idRTRW' => $this->idRTTerpilih])->get()->toArray();
            $this->investasi = Arr::map($investasi, function ($value) {
                return [
                    ...$value,
                    'anggaran' => Number::currency(intval($value['anggaran']), 'IDR', 'id')
                ];
            });
        }
        $this->dispatch('updated-investasi');
    }

    public function updatedTahun()
    {
        if ($this->idRTTerpilih) {
            $this->updatedidRTTerpilih();
        } else {
            $this->updatedidKawasanTerpilih();
        }
    }


    public function mount()
    {
        $this->user = Auth::user();
        if ($this->user->role == 'admin') {
            // ambil semua kawasan
            $this->kawasan = Kawasan::umum();
        } else {
            // hanya kawasan yang di wenangi sekaligus rt
            $this->kawasan = Kawasan::where(['id' => $this->user->kawasan_id])->get(['id', 'kawasan'])->first()->toArray();
            $this->idKawasanTerpilih = $this->kawasan['id'];
        }
    }

    public function render()
    {
        return view('livewire.investasi');
    }
}
