<?php

namespace Tests\Feature\Console;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan;

class MakeJsonApiDemoTest extends TestCase
{
    /**
     *
     */
    public function testMakeDemoCreateRemove()
    {
        $structure = [
                'Controllers/UsersController.stub',

                'Models/Role.stub',

                'JsonApi/Users/Adapter.php',
                'JsonApi/Users/Hydrator.php',
                'JsonApi/Users/Schema.php',
                'JsonApi/Users/Validators.php',

                'JsonApi/Roles/Adapter.php',
                'JsonApi/Roles/Hydrator.php',
                'JsonApi/Roles/Schema.php',
                'JsonApi/Roles/Validators.php',

                'JsonApi/Activations/Adapter.php',
                'JsonApi/Activations/Hydrator.php',
                'JsonApi/Activations/Schema.php',
                'JsonApi/Activations/Validators.php',
        ];

        vfsStream::copyFromFileSystem(base_path('stubs'), vfsStream::setup('app'));

        $result = true;
        foreach ($structure as $file) {
            if (!@unlink(vfsStream::url('app/'. $file))) {
                $result = $file;
            }
        }

        $this->assertTrue($result);
    }


    /**
     *
     */
    public function testMakeDemo()
    {
        Artisan::call('make:demo',
            [
                '--test' => true,
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
        Artisan::call('make:demo-remove',
            [
                '--test' => true
            ]
        );

        $this->assertTrue(true);
    }
}
