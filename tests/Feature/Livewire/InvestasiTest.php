<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Investasi;
use App\Models\Investasi as InvestasiModel;
use App\Models\Kawasan;
use App\Models\KumuhKawasan;
use App\Models\KumuhRT;
use App\Models\Rtrw;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class InvestasiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_render_component()
    {
        // Simulasi user
        $user = User::factory()->create(['role' => 'admin']);

        // Acting as the user
        $this->actingAs($user);

        // Render the component
        Livewire::test(Investasi::class)
            ->assertStatus(200)
            ->assertSee('Investasi');
    }

    public function test_it_can_save_investasi()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $kawasan = Kawasan::factory()->create();
        $rtrw = Rtrw::factory()->create();
        KumuhKawasan::factory()->create([
            'id_kawasan' => $kawasan->id_kawasan,
            'tahun' => now()->year - 1,
        ]);

        $this->actingAs($user);

        Livewire::test(Investasi::class)
            ->set('tahun', now()->year)
            ->set('idKawasanTerpilih', $kawasan->id_kawasan)
            ->set('idRTTerpilih', $rtrw->id_rtrw)
            ->set('form.kegiatan', 'Jalan Makadam')
            ->set('form.sumberAnggaran', 'APBD')
            ->set('form.volume', 100)
            ->set('form.anggaran', 1000000)
            ->set('form.idKriteria', '1a')
            ->call('save')
            ->assertSessionHasNoErrors();


        $this->assertDatabaseHas('investasi', [
            'tahun' => now()->year,
            'id_kawasan' => $kawasan->id_kawasan,
            'id_rtrw' => $rtrw->id_rtrw,
            'id_user' => $user->id_user,
        ]);
    }

    public function test_it_can_lock_data()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $kawasan = Kawasan::factory()->create();
        $investasi = InvestasiModel::factory()->create([
            'tahun' => now()->year,
            'id_kawasan' => $kawasan->id_kawasan,
            'locked' => 0,
        ]);
        KumuhKawasan::factory()->create([
            'id_kawasan' => $kawasan->id_kawasan,
            'tahun' => now()->year - 1,
        ]);

        $this->actingAs($user);

        Livewire::test(Investasi::class)
            ->set('tahun', now()->year)
            ->set('idKawasanTerpilih', $kawasan->id_kawasan)
            ->call('lock')
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('investasi', [
            'id_investasi' => $investasi->id_investasi,
            'locked' => 2,
        ]);
    }

    public function test_it_can_update_id_kawasan_terpilih()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $kawasan = Kawasan::factory()->create();
        $rtrws = Rtrw::factory()->count(3)->create([
            'id_kawasan' => $kawasan->id_kawasan,
        ]);
        KumuhKawasan::factory()->create([
            'id_kawasan' => $kawasan->id_kawasan,
            'tahun' => now()->year - 1,
        ]);

        $this->actingAs($user);

        Livewire::test(Investasi::class)
            ->set('idKawasanTerpilih', $kawasan->id_kawasan)
            ->assertSee($rtrws[2]->rtrw);
    }
}
