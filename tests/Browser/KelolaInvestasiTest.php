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
                ->assertPresent('@header-investasi')
                ->assertPresent('@table-investasi'); // Pastikan tabel investasi ada

        });
    }

    public function testCreateInvestasi()
    {
        $this->browse(function (Browser $browser) {
            $admin = User::find(1);


            $browser->loginAs($admin)
                ->visit('/investasi')
                ->select('@select-wilayah', '1') // Pilih ID Kawasan
                ->pause(3000)
                ->select('@select-rtrw', '2') // Pilih ID Kawasan
                ->waitFor('@create-investasi-button')
                ->click('@create-investasi-button') // Klik tombol tambah
                ->type('volume', '50') // Isi volume
                ->select('kegiatan', 'Jalan Aspal Hotmix')
                ->select('sumberAnggaran', 'APBN')
                ->type('anggaran', '50000000')
                ->press('@btn-add-investasi') // Simpan data
                ->waitFor('@alert-toast')
                ->assertSee('berhasil menambah investasi') // Verifikasi pesan sukses
                ->assertSee('Jalan Aspal Hotmix') // Verifikasi data muncul di tabel
                ->assertSee('APBN');
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
                ->select('@select-wilayah', '1') // Pilih ID Kawasan
                ->pause(3000)
                ->select('@select-rtrw', '2') // Pilih ID Kawasan
                ->waitFor('@hapus-investasi-button')
                ->click("@hapus-investasi-button") // Klik tombol hapus
                ->acceptDialog() // Konfirmasi dialog hapus
                ->pause(1000)
                ->assertSee('berhasil menghapus investasi') // Verifikasi pesan sukses
                ->assertDontSee('Pembangunan Drainase'); // Verifikasi data tidak ada di tabel
        });
    }
}
