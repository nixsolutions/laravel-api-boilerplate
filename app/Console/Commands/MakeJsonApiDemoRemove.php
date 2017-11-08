<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use League\Flysystem\Exception;

class MakeJsonApiDemoRemove extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:demo-remove
            {--test  : Add files postfix for test}';

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
        'UsersController.stub' => 'UsersController.php'
    ];

    /**
     * @var array
     */
    protected $models = [
        'Role.stub' => 'Role.php',
    ];

    // migrate_name_table.stub => migrate_name_table.php
    protected $migrations = [];

    // TableNameTableSeeder.stub => TableNameTableSeeder.php
    protected $seeds = [];

    protected $dirNames = [
        'JsonApi/Users',
        'JsonApi/Roles',
        'JsonApi/Activations',
    ];

    protected $jsonapiEntities = [
        'JsonApi/Users/Adapter.php'     => 'JsonApi/Users/Adapter.php',
        'JsonApi/Users/Hydrator.php'    => 'JsonApi/Users/Hydrator.php',
        'JsonApi/Users/Schema.php'      => 'JsonApi/Users/Schema.php',
        'JsonApi/Users/Validators.php'  => 'JsonApi/Users/Validators.php',

        'JsonApi/Roles/Adapter.php'     => 'JsonApi/Roles/Adapter.php',
        'JsonApi/Roles/Hydrator.php'    => 'JsonApi/Roles/Hydrator.php',
        'JsonApi/Roles/Schema.php'      => 'JsonApi/Roles/Schema.php',
        'JsonApi/Roles/Validators.php'  => 'JsonApi/Roles/Validators.php',

        'JsonApi/Activations/Adapter.php'     => 'JsonApi/Activations/Adapter.php',
        'JsonApi/Activations/Hydrator.php'    => 'JsonApi/Activations/Hydrator.php',
        'JsonApi/Activations/Schema.php'      => 'JsonApi/Activations/Schema.php',
        'JsonApi/Activations/Validators.php'  => 'JsonApi/Activations/Validators.php',
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

        $this->removeJsonApiEntities();
        $this->removeModels();
        $this->removeControllers();

        $this->removeSeeds();
        $this->removeMigrations();

        if (!$this->option('test')) {
            $this::call('optimize');
        }

        $this->info('JsonApi demo entities removed successfully.');
    }

    /**
     *
     */
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
        foreach ($this->jsonapiEntities as $key => $value) {
            $this->jsonapiEntities[$key] = $value . $this->testPostfix;
        }
    }

    /**
     *
     */
    protected function removeModels()
    {
        foreach ($this->models as $key => $value) {
            if (file_exists(app_path('Models/' . $value))) {
                unlink(app_path('Models/' . $value));
            }
        }
    }

    /**
     *
     */
    protected function removeControllers()
    {
        foreach ($this->controllers as $key => $value) {
            if (file_exists(app_path('Http/Controllers/Api/v1/' . $value))) {
                unlink(app_path('Http/Controllers/Api/v1/' . $value));
            }
        }
    }

    /**
     *
     */
    protected function removeMigrations()
    {
        foreach ($this->migrations as $key => $value) {
            $mask = database_path('migrations/*' . $value);
            array_map( "unlink", glob( $mask ) );
        }
    }

    /**
     *
     */
    protected function removeSeeds()
    {
        foreach ($this->seeds as $key => $value) {
            if (file_exists(database_path('seeds/' . $value))) {
                unlink(database_path('seeds/' . $value));
            }
        }
    }

    /**
     *
     */
    protected function removeJsonApiEntities()
    {
        try {
            foreach ($this->jsonapiEntities as $key => $value) {
                if (file_exists(app_path($value))) {
                    unlink(app_path($value));
                }
            }
            foreach ($this->dirNames as $dirName) {
                if ($this->option('test')) {
                    if (glob(app_path($dirName) . '/*.php' . $this->testPostfix)) {
                        throw new Exception($dirName . ' directory is not empty! Test files are there!');
                    }
                } else {
                    if (file_exists(app_path($dirName))) {
                        rmdir(app_path($dirName));
                    }
                }
            }

            if (file_exists(app_path('JsonApi'))) {
                if(!@rmdir(app_path('JsonApi'))) {
                     throw new Exception('JsonApi directory is not empty!');
                };
            }
        } catch (Exception $e) {
            $this->warn($e->getMessage());
        }
    }
}
