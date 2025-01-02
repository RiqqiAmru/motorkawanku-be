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
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

        $this->namaKawasan = Kawasan::where('id_kawasan', $this->idKawasanTerpilih)->get('kawasan')->first()?->toArray();
        $this->daftarRT = Rtrw::where(['id_kawasan' => $this->idKawasanTerpilih])?->pluck('rtrw', 'id_rtrw')->all();

        $this->kumuhKawasan = KumuhKawasan::where(['id_kawasan' => $this->idKawasanTerpilih])->orderBy('tahun')->get(['tahun', 'totalNilai', 'tingkatKekumuhan']);

        $kumuhRT = KumuhRT::where(['id_kawasan' => $this->idKawasanTerpilih])->get(['id_rtrw', 'tahun', 'totalNilai', 'tingkatKekumuhan']);
        $this->kumuhRT = $kumuhRT->groupby('id_rtrw')->all();
    }

    public function render()
    {
        return view('livewire.capaian');
    }

    public function export()
    {
        // Fetch the data you want to export


        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();


        $sheet->fromArray([
            ['Kawasan', 'Tahun', 'Total Nilai',]
        ]);


        // Create a writer instance to output the Excel file
        $writer = new Xlsx($spreadsheet);

        // Output the file to the browser for download
        $filename = 'laporan.xlsx';
        return response()->stream(
            function () use ($writer) {
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => "attachment; filename=\"$filename\"",
            ]
        );
    }
}