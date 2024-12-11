<?php

namespace Tests\Browser;

use App\Models\Investasi;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class KelolaInvestasiTest extends DuskTestCase
{

    public function testVisitInvestasiPage()
    {
        $this->browse(function (Browser $browser) {
            $admin = User::find(1);

            $browser->loginAs($admin)
                ->visit('/investasi') // Sesuaikan URL dengan rute Anda
                ->assertSeeIn('h3', 'Data Investasi ') // Verifikasi konten utama
                ->assertPresent('@table-investasi'); // Pastikan tabel investasi ada

        });
    }

    public function testCreateInvestasi()
    {
        $this->browse(function (Browser $browser) {
            $admin = User::find(1);


            $browser->loginAs($admin)
                ->visit('/investasi')
                ->click('@create-investasi-button') // Klik tombol tambah
                ->type('tahun', '2024')
                ->select('idKawasan', '1') // Pilih ID Kawasan
                ->select('idRTRW', '2') // Pilih ID RTRW
                ->type('idkriteria', '1a') // Isi kriteria
                ->type('volume', '50') // Isi volume
                ->type('kegiatan', 'Pembangunan Jalan')
                ->type('sumberAnggaran', 'APBN')
                ->type('anggaran', '50000000')
                ->press('@save-button') // Simpan data
                ->assertSee('berhasil menambah investasi') // Verifikasi pesan sukses
                ->assertSee('Pembangunan Jalan') // Verifikasi data muncul di tabel
                ->assertSee('2024');
        });
    }

    public function testEditInvestasi()
    {
        $this->browse(function (Browser $browser) {
            $admin = User::find(1);

            $investasi = Investasi::find(1);

            $browser->loginAs($admin)
                ->visit('/investasi')
                ->click("@edit-button-{$investasi->id}") // Gunakan atribut unik untuk tombol edit
                ->type('kegiatan', 'Pembangunan Jalan Baru') // Edit field
                ->press('@save-button') // Simpan perubahan
                ->assertSee('berhasil mengupdate investasi') // Verifikasi pesan sukses
                ->assertSee('Pembangunan Jalan Baru'); // Verifikasi data baru di tabel
        });
    }

    public function testDeleteInvestasi()
    {
        $this->browse(function (Browser $browser) {
            $admin = User::find(1);

            $investasi = Investasi::find(1);

            $browser->loginAs($admin)
                ->visit('/investasi')
                ->click("@delete-button-{$investasi->id}") // Klik tombol hapus
                ->acceptDialog() // Konfirmasi dialog hapus
                ->assertSee('berhasil menghapus investasi') // Verifikasi pesan sukses
                ->assertDontSee('Pembangunan Drainase'); // Verifikasi data tidak ada di tabel
        });
    }
}
