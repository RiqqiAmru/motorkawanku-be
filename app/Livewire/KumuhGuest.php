<?php

namespace App\Livewire;

use App\Models\Kawasan;
use App\Models\Latlang;
use App\Models\Rtrw;
use Livewire\Component;

class KumuhGuest extends Component
{
    public $idKawasanTerpilih;
    public $idRTTerpilih = null;
    public $daftarRT = null;
    public $kawasanTerpilih = null;
    public $coordinate = ['main' => null, 'secondary' => null];

    public function updatedidKawasanTerpilih($idKawasanTerpilih)
    {
        $this->kawasanTerpilih = Kawasan::find($idKawasanTerpilih);
        $this->reset('idRTTerpilih');
        $this->daftarRT = Rtrw::where('kawasan', $idKawasanTerpilih)->get(['id', 'rtrw']);
        $this->coordinate['main'] = Latlang::where('kelurahan', $this->kawasanTerpilih->kawasan)->first();
        $this->coordinate['secondary'] = Latlang::where('kelurahan', $this->kawasanTerpilih->wilayah)->first();
    }

    public function updatedidRTTerpilih($idRTTerpilih)
    {
        $this->kawasanTerpilih = Rtrw::find($idRTTerpilih);
    }

    public function render()
    {
        return view('livewire.kumuh-guest')->with(['kawasan' => Kawasan::umum()]);
    }
}
