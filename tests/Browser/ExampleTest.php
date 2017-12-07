<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends DuskTestCase
{
  use DatabaseMigrations;
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertPathIs('/de')
                    ->assertSee('Über Uns');

            $browser->visit('/en')
                    ->assertSee('About Us');

            $browser->visit('/ru')
                    ->assertSee('о нас');

        });
    }
}
