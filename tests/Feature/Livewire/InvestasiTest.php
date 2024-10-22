<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Investasi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class InvestasiTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Investasi::class)
            ->assertStatus(200);
    }
}
