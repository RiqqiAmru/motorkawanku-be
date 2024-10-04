<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;
    public function sestUpBeforeEach(): void {}
    public function test_user_page_load_successfully(): void
    {
        $user = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($user)->get('/users');
        $response->assertStatus(200);
    }
    public function test_user_page_load_a_user_data(): void
    {
        $user = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($user)->get('/users');
        $response->assertViewHas('users');
    }
    public function test_there_is_kawasan_field_at_users_database(): void
    {
        $user = User::factory()->create();
        $this->assertArrayHasKey('kawasan_id', $user);
    }
    // ada data kawasan yang di bawa ke view users
    public function test_there_is_kawasan_data_in_users_view(): void
    {
        $user = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($user)->get('/users');
        $response->assertViewHas('kawasan');
    }
    // ada dropdown kawasan di tambah/edit
    public function test_there_is_kawasan_dropdown_in_users_view(): void
    {
        $user = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($user)->get('/users');
        $response->assertSeeHtml('<select name="kawasan" id="kawasan"');
    }
    // (validasi fe)
    // ketika admin memilih hendak menambah/edit role menjadi admin -> dropdown kawasan reset
    // jika diubah ke role user -> dropdown kawasan (required)
    
}
