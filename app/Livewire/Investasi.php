<?php

namespace App\Livewire;

use App\Models\Kawasan;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Investasi extends Component
{
    public $user = null;
    public $kawasan = null;
    public $idKawasanTerpilih = null;
    public $rt = null;
    public $tahun = 2024;

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
