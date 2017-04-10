<?php

namespace Tests\Feature\Console;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan;

class MakeJsonApiDemoTest extends TestCase
{
    use DatabaseTransactions;

    /**
     *
     */
    public function testMakeDemo()
    {
        Artisan::call('make:demo',
            [
                '--force' => true
            ]
        );

        $this->assertTrue(true);
    }

    /**
     *
     */
    public function testMakeDemoRemove()
    {
        Artisan::call('make:demo-remove');

        $this->assertTrue(true);
    }
}
