<?php

namespace App\Livewire;

use App\Models\Investasi;
use App\Models\Kawasan;
use App\Models\KumuhKawasan;
use App\Models\KumuhRT;
use App\Models\Rtrw;
use Livewire\Component;
use Carbon\Carbon;
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
        $filePath = storage_path('kumuhR0.xlsx');
        // Membaca file Excel
        $spreadsheet = IOFactory::load($filePath);

        // Ambil sheet pertama (index 0)
        $sheet = $spreadsheet->getSheet(1);

        $kawasan = Kawasan::where('id_kawasan', $this->idKawasanTerpilih)->get()->toArray();
        $rt = Rtrw::where('id_kawasan', $this->idKawasanTerpilih)->get()->toArray();

        // Mendapatkan objek tabel (misalnya Table1)
        $sheet->setCellValue('B2', $kawasan[0]['kawasan']);
        $sheet->setCellValue('B1', $kawasan[0]['wilayah']);

        $kawasan[0]['rtrw'] = 'pilih rt';
        $kawasan[0]['id_rtrw'] = '0';
        // gabung data kawasan dengan data rt
        $data = array_merge($kawasan, $rt);


        // hapus semua data lama dari row 5 kebawah
        $sheet->removeRow(5, 1000);
        // isi data kawasan
        $row = 5;
        foreach ($data as $key => $value) {
            $sheet->setCellValue('C' . $row, $value['id_rtrw']);
            $sheet->setCellValue('D' . $row, $value['rtrw']);
            $sheet->setCellValue('E' . $row, $value['luasFlag']);
            $sheet->setCellValue('F' . $row, $value['jumlahBangunan']);
            $sheet->setCellValue('G' . $row, $value['jumlahPenduduk']);
            $sheet->setCellValue('H' . $row, $value['jumlahKK']);
            $sheet->setCellValue('I' . $row, $value['panjangJalanIdeal']);
            $sheet->setCellValue('J' . $row, $value['panjangDrainaseIdeal']);
            $row++;
        }

        // isi data kumuh kawasan
        $kumuhKawasan = KumuhKawasan::where('id_kawasan', $this->idKawasanTerpilih)->get(['tahun', '1av', '1bv', '1cv', '2av', '2bv', '3av', '3bv', '4av', '4bv', '4cv', '5av', '5bv', '6av', '6bv', '7av', '7bv'])->toArray();
        $row = 5;
        foreach ($kumuhKawasan as $key => $value) {
            $sheet->setCellValue('L' . $row, 'pilih rt');
            $sheet->setCellValue('M' . $row, $value['tahun']);
            $sheet->setCellValue('N' . $row, $value['1av']);
            $sheet->setCellValue('O' . $row, $value['1bv']);
            $sheet->setCellValue('P' . $row, $value['1cv']);
            $sheet->setCellValue('Q' . $row, $value['2av']);
            $sheet->setCellValue('R' . $row, $value['2bv']);
            $sheet->setCellValue('S' . $row, $value['3av']);
            $sheet->setCellValue('T' . $row, $value['3bv']);
            $sheet->setCellValue('U' . $row, $value['4av']);
            $sheet->setCellValue('V' . $row, $value['4bv']);
            $sheet->setCellValue('W' . $row, $value['4cv']);
            $sheet->setCellValue('X' . $row, $value['5av']);
            $sheet->setCellValue('Y' . $row, $value['5bv']);
            $sheet->setCellValue('Z' . $row, $value['6av']);
            $sheet->setCellValue('AA' . $row, $value['6bv']);
            $sheet->setCellValue('AB' . $row, $value['7av']);
            $sheet->setCellValue('AC' . $row, $value['7bv']);
            $sheet->setCellValue('AE' . $row, $value['tahun']);
            $row++;
        }

        // isi data kumuh rt join tabel rt
        $kumuhRT = KumuhRT::where('kumuh_rt.id_kawasan', $this->idKawasanTerpilih)->join('rtrw', 'kumuh_rt.id_rtrw', '=', 'rtrw.id_rtrw')->get(['rtrw.rtrw', 'kumuh_rt.tahun', '1av', '1bv', '1cv', '2av', '2bv', '3av', '3bv', '4av', '4bv', '4cv', '5av', '5bv', '6av', '6bv', '7av', '7bv'])->toArray();

        foreach ($kumuhRT as $key => $value) {
            $sheet->setCellValue('L' . $row, $value['rtrw']);
            $sheet->setCellValue('M' . $row, $value['tahun']);
            $sheet->setCellValue('N' . $row, $value['1av']);
            $sheet->setCellValue('O' . $row, $value['1bv']);
            $sheet->setCellValue('P' . $row, $value['1cv']);
            $sheet->setCellValue('Q' . $row, $value['2av']);
            $sheet->setCellValue('R' . $row, $value['2bv']);
            $sheet->setCellValue('S' . $row, $value['3av']);
            $sheet->setCellValue('T' . $row, $value['3bv']);
            $sheet->setCellValue('U' . $row, $value['4av']);
            $sheet->setCellValue('V' . $row, $value['4bv']);
            $sheet->setCellValue('W' . $row, $value['4cv']);
            $sheet->setCellValue('X' . $row, $value['5av']);
            $sheet->setCellValue('Y' . $row, $value['5bv']);
            $sheet->setCellValue('Z' . $row, $value['6av']);
            $sheet->setCellValue('AA' . $row, $value['6bv']);
            $sheet->setCellValue('AB' . $row, $value['7av']);
            $sheet->setCellValue('AC' . $row, $value['7bv']);
            $row++;
        }


        // investasi
        $investasi = Investasi::where('id_kawasan', $this->idKawasanTerpilih)->get(['volume', 'kegiatan', 'tahun', 'id_rtrw', 'idkriteria'])->toArray();
        $row = 5;
        foreach ($investasi as $key => $value) {
            $sheet->setCellValue('AG' . $row, $value['volume']);
            $sheet->setCellValue('AH' . $row, $value['kegiatan']);
            $sheet->setCellValue('AI' . $row, $value['tahun']);
            $sheet->setCellValue('AJ' . $row, $value['id_rtrw']);
            $sheet->setCellValue('AK' . $row, $value['idkriteria']);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        // return file ke browser
        $fileName = $kawasan[0]['kawasan'] . '_R0.xlsx';
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment;filename="' . $fileName . '"',
            'Cache-Control' => 'max-age=0',
        ];
        // return response if eror
        return response()->stream(
            function () use ($writer) {
                $writer->save('php://output');
            },
            200,
            $headers
        );
    }
}
