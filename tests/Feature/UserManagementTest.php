<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;
    public function sestUpBeforeEach():void {}
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
    public function test_can_add_a_new_user_data(): void {}
}
