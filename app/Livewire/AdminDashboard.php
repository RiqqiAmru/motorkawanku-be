<?php

namespace App\Livewire;

use App\Models\Investasi;
use Livewire\Component;
use Carbon\Carbon;


class AdminDashboard extends Component
{
    public $tahun = null;
    public $investasi = '';

    public function mount()
    {
        $this->tahun = Carbon::now()->year;
        $this->investasi = Investasi::where(['tahun' => $this->tahun])->orderBy('idKawasan')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.admin-dashboard');
    }
}
