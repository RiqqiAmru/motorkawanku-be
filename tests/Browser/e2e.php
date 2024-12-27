<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class e2e extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testEndToEnd(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Motor Kawanku');
            // lihat kumuh tanpa login
        });
    }
}