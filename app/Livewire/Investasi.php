<?php

namespace App\Livewire;

use App\Livewire\Forms\InvForm;
use App\Models\Kawasan;
use App\Models\Rtrw;
use App\Models\Investasi as InvestasiModel;
use Carbon\Carbon;
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
    public $tahun = null;
    public $investasi = null;
    public $locked = false;

    public InvForm $form;


    public function lock()
    {
        InvestasiModel::where(['tahun' => $this->tahun, 'idKawasan' => $this->idKawasanTerpilih])->update(['locked' => 2]);
        $namaKawasan = Kawasan::where('id', $this->idKawasanTerpilih)->get()->first()->kawasan;
        session()->flash('info', 'Berhasil Mengunci Data Investasi ' . $namaKawasan);
    }

    public function save()
    {
        $this->form->store($this->tahun, $this->idKawasanTerpilih, $this->idRTTerpilih, $this->user->id);

        session()->flash('success', 'berhasil menambah investasi.');
        $this->updatedidRTTerpilih();
        $this->dispatch('close');
    }

    public function updatedidKawasanTerpilih()
    {
        $this->reset('rt');
        $this->reset('idRTTerpilih');
        $this->reset('investasi');
        $this->reset('locked');

        $this->rt = Rtrw::where(['kawasan' => $this->idKawasanTerpilih])->get(['id', 'rtrw'])->toArray();
        $investasi = InvestasiModel::where(['tahun' => $this->tahun, 'idKawasan' => $this->idKawasanTerpilih])->get()->toArray();
        $this->investasi = Arr::map($investasi, function ($value) {
            return [
                ...$value,
                'anggaran' => Number::currency(intval($value['anggaran']), 'IDR', 'id')
            ];
        });

        if ($this->investasi) {
            if ($this->investasi[0]['locked'] == 2) {
                $this->locked = true;
            }
        }

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

    public function delete($param)
    {
        $this->form->delete($param);
        $this->updatedidRTTerpilih();
    }



    public function mount()
    {
        $this->user = Auth::user();
        $this->tahun = Carbon::now()->year;

        if ($this->user->role == 'admin') {
            // ambil semua kawasan
            $this->kawasan = Kawasan::umum();
        } else {
            // hanya kawasan yang di wenangi sekaligus rt
            $this->kawasan = Kawasan::where(['id' => $this->user->kawasan_id])->get(['id', 'kawasan'])->first()->toArray();
            $this->idKawasanTerpilih = $this->kawasan['id'];
            $this->updatedidKawasanTerpilih();
        }
    }

    public function render()
    {
        return view('livewire.investasi');
    }
}