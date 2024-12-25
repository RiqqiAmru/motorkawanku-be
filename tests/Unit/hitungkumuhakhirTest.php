<?php

namespace Tests\Unit;

use App\Livewire\AdminDashboard;
use PHPUnit\Framework\TestCase;

class hitungkumuhakhirTest extends TestCase
{
    private $classInstance;

    protected function setUp(): void
    {
        $this->classInstance = new AdminDashboard();
    }

    public function testTotalVolumeInvestasiBasic()
    {
        $investasi = [
            ['idkriteria' => '1a', 'volume' => 10, 'kegiatan' => 'Pembangunan 1'],
            ['idkriteria' => '1a', 'volume' => 20, 'kegiatan' => 'Pembangunan 2'],
            ['idkriteria' => '4a', 'volume' => 15, 'kegiatan' => 'Pembangunan tong sampah'],
        ];

        $headerRT = [
            'jumlahBangunan' => 100,
        ];

        $result = $this->classInstance->totalVolumeInvestasi($investasi, $headerRT);

        $this->assertArrayHasKey('1a', $result, "Result should contain '1a'");
        $this->assertArrayHasKey('4a', $result, "Result should contain '4a'");
        $this->assertEquals(30, $result['1a'], "Total volume for '1a' should be 30");
        $this->assertEquals(15, $result['4a'], "Total volume for '4a' should be 15");
    }

    public function test_hitung_prosen_kumuh()
    {
        $headerRT = [
            'jumlahBangunan' => 100,
            'luasVerifikasi' => 200,
            'panjangJalanIdeal' => 50,
            'jumlahKK' => 300,
            'panjangDrainaseIdeal' => 30,
        ];

        $result1 = $this->classInstance->hitungProsenKumuh(50, '1a', $headerRT);
        $this->assertEquals(0.5, $result1, "Error in case '1a'");

        $result2 = $this->classInstance->hitungProsenKumuh(100, '4a', $headerRT);
        $this->assertEquals(0.5, $result2, "Error in case '4a'");
    }

    public function test_hitung_nilai_kumuh()
    {
        $this->assertEquals(5, $this->classInstance->hitungNilaiKumuh(0.8), "High percentage should return 5");
        $this->assertEquals(3, $this->classInstance->hitungNilaiKumuh(0.6), "Medium-high percentage should return 3");
        $this->assertEquals(1, $this->classInstance->hitungNilaiKumuh(0.3), "Medium percentage should return 1");
        $this->assertEquals(0, $this->classInstance->hitungNilaiKumuh(0.1), "Low percentage should return 0");
    }

    public function test_hitung_kumuh_rt_akhir()
    {
        $dataVolume = [
            '1a' => 20,
            '1b' => 10,
            '1c' => 15,
        ];

        $kumuhRTAwal = [
            "id" => 1,
            "id_kawasan" => 1,
            "tahun" => 2019,
            "id_rtrw" => 1,
            "1av" => 326,
            "1ap" => 0.7581395348837209,
            "1an" => 3,
            "1bv" => 0,
            "1bp" => 0,
            "1bn" => 0,
            "1cv" => 61,
            "1cp" => 0.14186046511627906,
            "1cn" => 0,
            "1r" => 0.2527131782945736,
            "2av" => 0,
            "2ap" => 0,
            "2an" => 0,
            "2bv" => 828,
            "2bp" => 0.20165611300535802,
            "2bn" => 0,
            "2r" => 0,
            "3av" => 279,
            "3ap" => 0.46812080536912754,
            "3an" => 1,
            "3bv" => 0,
            "3bp" => 0,
            "3bn" => 0,
            "3r" => 0.23406040268456377,
            "4av" => -0.6307010000000002,
            "4ap" => -0.054467977724731026,
            "4an" => 0,
            "4bv" => 2247,
            "4bp" => 0.47087175188600167,
            "4bn" => 1,
            "4cv" => 475,
            "4cp" => 0.09953897736797988,
            "4cn" => 0,
            "4r" => 0.15695725062866722,
            "5av" => 43,
            "5ap" => 0.07214765100671142,
            "5an" => 0,
            "5bv" => 8,
            "5bp" => 0.013422818791946308,
            "5bn" => 0,
            "5r" => 0,
            "6av" => 458,
            "6ap" => 0.7684563758389261,
            "6an" => 5,
            "6bv" => 116,
            "6bp" => 0.19463087248322147,
            "6bn" => 0,
            "6r" => 0.38422818791946306,
            "7av" => 125,
            "7ap" => 0.29069767441860467,
            "7an" => 1,
            "7bv" => 356,
            "7bp" => 0.827906976744186,
            "7bn" => 5,
            "7r" => 0.5593023255813954,
            "totalNilai" => 16,
            "tingkatKekumuhan" => "KR",
            "ratarataKekumuhan" => 0.226751620729809,
            "kontribusiPenanganan" => 0
        ];

        $headerRT = [
            'jumlahBangunan' => 100,
            'luasVerifikasi' => 200,
            'panjangJalanIdeal' => 50,
            'jumlahKK' => 300,
            'panjangDrainaseIdeal' => 30,
        ];

        $result = $this->classInstance->hitungKumuhRtAkhir($dataVolume, $kumuhRTAwal, $headerRT);

        $this->assertArrayHasKey('tingkatKekumuhan', $result, "Result should include 'tingkatKekumuhan'");
        $this->assertEquals(1, $result['id_kawasan'], "Kawasan should match");
        $this->assertLessThanOrEqual($kumuhRTAwal['1av'], $result['1av'], "Rata-rata kekumuhan should decrease");
        $this->assertLessThanOrEqual($kumuhRTAwal['1bv'], $result['1bv'], "Rata-rata kekumuhan should decrease");
        $this->assertLessThanOrEqual($kumuhRTAwal['1cv'], $result['1cv'], "Rata-rata kekumuhan should decrease");
    }
}
