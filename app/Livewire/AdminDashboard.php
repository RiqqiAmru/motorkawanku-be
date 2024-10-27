<?php

namespace App\Livewire;

use App\Models\Investasi;
use Livewire\Component;
use Carbon\Carbon;


class AdminDashboard extends Component
{
    public $tahun = null;
    public $terkunci = '';

    public function mount()
    {
        $this->tahun = Carbon::now()->year;
        $this->terkunci = Investasi::where(['tahun' => $this->tahun, 'locked' => 2])->orderBy('idKawasan')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.admin-dashboard');
    }
}
