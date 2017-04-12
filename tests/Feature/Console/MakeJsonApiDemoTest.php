<?php

namespace Tests\Feature\Console;

use Mockery;
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

               'Controllers/LikesController.stub',
                'Controllers/SkillsController.stub',
                'Controllers/TeamsController.stub',
                'Controllers/UsersController.stub',

                'Models/Like.stub',
                'Models/Role.stub',
                'Models/Skill.stub',
                'Models/Team.stub',

                'migrations/add_foreign_keys_to_likes_table.stub',
                'migrations/add_foreign_keys_to_membership_table.stub',
                'migrations/add_foreign_keys_to_skills_table.stub',
                'migrations/add_foreign_keys_to_teams_table.stub',
                'migrations/create_likes_table.stub',
                'migrations/create_membership_table.stub',
                'migrations/create_skills_table.stub',
                'migrations/create_teams_table.stub',

                'seeds/JsonApiSeeder.stub',
                'seeds/TeamsTableSeeder.stub',
                'seeds/TeamUsersTableSeeder.stub',

                'JsonApi/Likes/Hydrator.php',
                'JsonApi/Likes/Request.php',
                'JsonApi/Likes/Schema.php',
                'JsonApi/Likes/Search.php',
                'JsonApi/Likes/Validators.php',
                'JsonApi/Skills/Hydrator.php',
                'JsonApi/Skills/Request.php',
                'JsonApi/Skills/Schema.php',
                'JsonApi/Skills/Search.php',
                'JsonApi/Skills/Validators.php',
                'JsonApi/Teams/Hydrator.php',
                'JsonApi/Teams/Request.php',
                'JsonApi/Teams/Schema.php',
                'JsonApi/Teams/Search.php',
                'JsonApi/Teams/Validators.php',
                'JsonApi/Users/Hydrator.php',
                'JsonApi/Users/Request.php',
                'JsonApi/Users/Schema.php',
                'JsonApi/Users/Search.php',
                'JsonApi/Users/Validators.php',
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
                '--fake' => true
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
                '--fake' => true
            ]
        );

        $this->assertTrue(true);
    }
}
