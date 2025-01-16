<?php

namespace App\Livewire;

use App\Models\Investasi;
use App\Models\Kawasan;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserDashboard extends Component
{
    public $tahun = null;
    public $allInvestasi = '';

    public $user = null;
    public $kawasan = null;

    public function mount()
    {
        $this->tahun = Carbon::now()->year;
        $this->allInvestasi = Investasi::where(['tahun' => $this->tahun])->orderBy('id_kawasan')->get()->toArray();

        $this->allInvestasi  = DB::table('investasi')
            ->join('kawasan', 'investasi.id_kawasan', '=', 'kawasan.id_kawasan')
            ->join('rtrw', 'investasi.id_rtrw', '=', 'rtrw.id_rtrw')
            ->join('users', 'investasi.id_user', '=', 'users.id_user')
            ->select('investasi.*', 'kawasan.kawasan', 'rtrw.rtrw', 'users.name')->orderBy('investasi.id_kawasan')
            ->where('investasi.id_kawasan', Auth::user()->kawasan_id)
            ->get()->toArray();
        $this->user = Auth::user();
        $this->kawasan = Kawasan::where('id_kawasan', Auth::user()->kawasan_id)->first()->kawasan;
    }

    public function destroy($id)
    {
        Investasi::find($id)->delete();
        session()->flash('success', 'berhasil menghapus investasi.');
        $this->mount();
        $this->dispatch('close');
    }

    public function render()
    {
        return view('livewire.user-dashboard');
    }
}
