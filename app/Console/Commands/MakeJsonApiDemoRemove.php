<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeJsonApiDemoRemove extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:demo-remove
            {--test  : Add files postfix for test}
            {--fake : Make fake removing directories and files for test}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove JsonApi Demo entities';

    protected $testPostfix = '-test';

    /**
     * @var array
     */
    protected $controllers = [
        'LikesController.stub' => 'LikesController.php',
        'SkillsController.stub' => 'SkillsController.php',
        'TeamsController.stub' => 'TeamsController.php',
        'UsersController.stub' => 'UsersController.php'
    ];

    protected $models = [
        'Like.stub' => 'Like.php',
        'Skill.stub' => 'Skill.php',
        'Team.stub' => 'Team.php'
    ];

    protected $migrations = [
        'create_likes_table.stub'                   => 'create_likes_table.php',
        'create_membership_table.stub'              => 'create_membership_table.php',
        'create_skills_table.stub'                  => 'create_skills_table.php',
        'create_teams_table.stub'                   => 'create_teams_table.php',
        'add_foreign_keys_to_likes_table.stub'      => 'add_foreign_keys_to_likes_table.php',
        'add_foreign_keys_to_membership_table.stub' => 'add_foreign_keys_to_membership_table.php',
        'add_foreign_keys_to_skills_table.stub'     => 'add_foreign_keys_to_skills_table.php',
        'add_foreign_keys_to_teams_table.stub'      => 'add_foreign_keys_to_teams_table.php'
    ];

    protected $seeds = [
        'TeamsTableSeeder.stub'     => 'TeamsTableSeeder.php',
        'TeamUsersTableSeeder.stub' => 'TeamUsersTableSeeder.php',
        'JsonApiSeeder.stub' => 'JsonApiSeeder.php'
    ];

    protected $jsonapiEntities = [
        'JsonApi/Likes/Hydrator.stub' => 'JsonApi/Likes/Hydrator.php',
        'JsonApi/Likes/Request.stub' => 'JsonApi/Likes/Request.php',
        'JsonApi/Likes/Schema.stub' => 'JsonApi/Likes/Schema.php',
        'JsonApi/Likes/Search.stub' => 'JsonApi/Likes/Search.php',
        'JsonApi/Likes/Validators.stub' => 'JsonApi/Likes/Validators.php',

        'JsonApi/Skills/Hydrator.stub' => 'JsonApi/Skills/Hydrator.php',
        'JsonApi/Skills/Request.stub' => 'JsonApi/Skills/Request.php',
        'JsonApi/Skills/Schema.stub' => 'JsonApi/Skills/Schema.php',
        'JsonApi/Skills/Search.stub' => 'JsonApi/Skills/Search.php',
        'JsonApi/Skills/Validators.stub' => 'JsonApi/Skills/Validators.php',

        'JsonApi/Teams/Hydrator.stub' => 'JsonApi/Teams/Hydrator.php',
        'JsonApi/Teams/Request.stub' => 'JsonApi/Teams/Request.php',
        'JsonApi/Teams/Schema.stub' => 'JsonApi/Teams/Schema.php',
        'JsonApi/Teams/Search.stub' => 'JsonApi/Teams/Search.php',
        'JsonApi/Teams/Validators.stub' => 'JsonApi/Teams/Validators.php',

        'JsonApi/Users/Hydrator.stub' => 'JsonApi/Users/Hydrator.php',
        'JsonApi/Users/Request.stub' => 'JsonApi/Users/Request.php',
        'JsonApi/Users/Schema.stub' => 'JsonApi/Users/Schema.php',
        'JsonApi/Users/Search.stub' => 'JsonApi/Users/Search.php',
        'JsonApi/Users/Validators.stub' => 'JsonApi/Users/Validators.php',
    ];

    protected $jsonapiEntitiesTest = [
        'JsonApi/Likes/Hydrator.stub' => 'JsonApi-test/Likes/Hydrator.php',
        'JsonApi/Likes/Request.stub' => 'JsonApi-test/Likes/Request.php',
        'JsonApi/Likes/Schema.stub' => 'JsonApi-test/Likes/Schema.php',
        'JsonApi/Likes/Search.stub' => 'JsonApi-test/Likes/Search.php',
        'JsonApi/Likes/Validators.stub' => 'JsonApi-test/Likes/Validators.php',

        'JsonApi/Skills/Hydrator.stub' => 'JsonApi-test/Skills/Hydrator.php',
        'JsonApi/Skills/Request.stub' => 'JsonApi-test/Skills/Request.php',
        'JsonApi/Skills/Schema.stub' => 'JsonApi-test/Skills/Schema.php',
        'JsonApi/Skills/Search.stub' => 'JsonApi-test/Skills/Search.php',
        'JsonApi/Skills/Validators.stub' => 'JsonApi-test/Skills/Validators.php',

        'JsonApi/Teams/Hydrator.stub' => 'JsonApi-test/Teams/Hydrator.php',
        'JsonApi/Teams/Request.stub' => 'JsonApi-test/Teams/Request.php',
        'JsonApi/Teams/Schema.stub' => 'JsonApi-test/Teams/Schema.php',
        'JsonApi/Teams/Search.stub' => 'JsonApi-test/Teams/Search.php',
        'JsonApi/Teams/Validators.stub' => 'JsonApi-test/Teams/Validators.php',

        'JsonApi/Users/Hydrator.stub' => 'JsonApi-test/Users/Hydrator.php',
        'JsonApi/Users/Request.stub' => 'JsonApi-test/Users/Request.php',
        'JsonApi/Users/Schema.stub' => 'JsonApi-test/Users/Schema.php',
        'JsonApi/Users/Search.stub' => 'JsonApi-test/Users/Search.php',
        'JsonApi/Users/Validators.stub' => 'JsonApi-test/Users/Validators.php',
    ];

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->option('test')) {
            $this->setupTest();
        }

        if($this->option('fake')) {
            $this->info('JsonApi demo entities fake removed successfully.');
            return true;
        }

        $this->removeJsonApiEntities();
        $this->removeModels();
        $this->removeControllers();

        $this->removeSeeds();
        $this->removeMigrations();

        $this::call('optimize');

        $this->info('JsonApi demo entities removed successfully.');
    }

    protected function setupTest()
    {
        foreach ($this->migrations as $key => $value) {
            $this->migrations[$key] = $value . $this->testPostfix;
        }
        foreach ($this->seeds as $key => $value) {
            $this->seeds[$key] = $value . $this->testPostfix;
        }
        foreach ($this->controllers as $key => $value) {
            $this->controllers[$key] = $value . $this->testPostfix;
        }
        foreach ($this->models as $key => $value) {
            $this->models[$key] = $value . $this->testPostfix;
        }
        $this->jsonapiEntities = $this->jsonapiEntitiesTest;

//        foreach ($this->jsonapiEntities as $key => $value) {
//            $this->jsonapiEntities[$key] = $value . $this->testPostfix;
//        }
    }

    protected function removeModels()
    {
        foreach ($this->models as $key => $value) {
            if (file_exists(app_path('Models/' . $value))) {
                unlink(app_path('Models/' . $value));
            }
        }
    }

    protected function removeControllers()
    {
        foreach ($this->controllers as $key => $value) {
            if (file_exists(app_path('Http/Controllers/Api/v1/' . $value))) {
                unlink(app_path('Http/Controllers/Api/v1/' . $value));
            }
        }
    }

    protected function removeMigrations()
    {
        foreach ($this->migrations as $key => $value) {
            $mask = database_path('migrations/*' . $value);
            array_map( "unlink", glob( $mask ) );
        }
    }

    protected function removeSeeds()
    {
        foreach ($this->seeds as $key => $value) {
            if (file_exists(database_path('seeds/' . $value))) {
                unlink(database_path('seeds/' . $value));
            }
        }
    }

    protected function removeJsonApiEntities()
    {
        try {
            foreach ($this->jsonapiEntities as $key => $value) {
                if (file_exists(app_path($value))) {
                    unlink(app_path($value));
                }
            }
            if (file_exists(app_path('JsonApi/Users'))) {
                rmdir(app_path('JsonApi/Users'));
            }

            if (file_exists(app_path('JsonApi/Likes'))) {
                rmdir(app_path('JsonApi/Likes'));
            }

            if (file_exists(app_path('JsonApi/Skills'))) {
                rmdir(app_path('JsonApi/Skills'));
            }

            if (file_exists(app_path('JsonApi/Teams'))) {
                rmdir(app_path('JsonApi/Teams'));
            }

            if (file_exists(app_path('JsonApi'))) {
                if(!@rmdir(app_path('JsonApi'))) {
                     throw new \League\Flysystem\Exception('JsonApi directory is not empty!');
                };
            }
        } catch (\League\Flysystem\Exception $e) {
            $this->warn($e->getMessage());
        }
    }
}
