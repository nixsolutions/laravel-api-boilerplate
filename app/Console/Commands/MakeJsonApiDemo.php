<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class MakeJsonApiDemo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:demo                    
                    {--force : Overwrite existing files by default}
                    {--test  : Add files postfix for test}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create JsonApi Demo entities';

    protected $testPostfix = '-test';

    // migrate_name_table.stub => migrate_name_table.php
    protected $migrations = [];

    // TableNameTableSeeder.stub => TableNameTableSeeder.php
    protected $seeds = [];

    /**
     * @var array
     */
    protected $dirNames = [
        'JsonApi/Users',
        'JsonApi/Roles',
        'JsonApi/Activations',
    ];

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
        'Activation.stub'   => 'Activation.php',
        'Role.stub'         => 'Role.php',
        'User.stub'         => 'User.php',
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
     */
    public function handle()
    {
        if ($this->option('test')) {
            $this->setupTest();
        }

        $this->fire();

        $this->exportControllers();
        $this->exportModels();

        if (!$this->option('test')) {
            $this::call('optimize');
        }

        $this->info('JsonApi demo entities generated successfully.');
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
        foreach ($this->jsonapiEntities as $key => $value) {
            $this->jsonapiEntities[$key] = $value . $this->testPostfix;
        }
    }

    public function fire()
    {
        $this->createDirectories($this->dirNames);

        $this->copyJsonApiEntities();
    }

    /**
     * @param array $dirNames
     */
    protected function createDirectories($dirNames)
    {
        foreach ($dirNames as $name) {
            if (!is_dir(app_path($name))) {
                mkdir(app_path($name), 0755, true);
            }
            continue;
        }
    }

    protected function copyJsonApiEntities()
    {
        foreach ($this->jsonapiEntities as $key => $value) {
            if (file_exists(app_path('JsonApi/'.$value)) && ! $this->option('force')) {
                if (! $this->confirm("The [{$value}] already exists. Do you want to replace it?")) {
                    continue;
                }
            }

            copy(
                base_path('stubs/'.$key),
                app_path($value)
            );
        }
    }

    protected function exportControllers()
    {
        foreach ($this->controllers as $key => $value) {
            if (file_exists(app_path('Http/Controllers/Api/v1/'.$value)) && ! $this->option('force')) {
                if (! $this->confirm("The [{$value}] already exists. Do you want to replace it?")) {
                    continue;
                }
            }

            copy(
                base_path('stubs/Controllers/'.$key),
                app_path('Http/Controllers/Api/v1/'.$value)
            );
        }
    }

    protected function exportModels()
    {
        foreach ($this->models as $key => $value) {
            if (file_exists(app_path('Models/'.$value)) && ! $this->option('force')) {
                if (! $this->confirm("The [{$value}] model already exists. Do you want to replace it?")) {
                    continue;
                }
            }

            copy(
                base_path('stubs/Models/'.$key),
                app_path('Models/'.$value)
            );
        }
    }

    protected function exportMigrations()
    {
        $counter = 0;
        foreach ($this->migrations as $key => $value) {
            if (file_exists(database_path('migrations/'.$value)) && ! $this->option('force')) {
                if (! $this->confirm("The [{$value}] migration already exists. Do you want to replace it?")) {
                    continue;
                }
            }

            copy(
                base_path('stubs/migrations/' . $key),
                database_path('migrations/'. date('Y_m_d_Hi') . '0' . $counter++ . '_' . $value)
            );
        }
    }

    protected function exportSeeds()
    {
        foreach ($this->seeds as $key => $value) {
            if (file_exists(database_path('seeds/'.$value)) && ! $this->option('force')) {
                if (! $this->confirm("The [{$value}] already exists. Do you want to replace it?")) {
                    continue;
                }
            }

            copy(
                base_path('stubs/seeds/'.$key),
                database_path('seeds/'.$value)
            );
        }
    }

    /**
     * @param $src
     * @param $dst
     */
    protected function recurse_copy($src,$dst)
    {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    $this->recurse_copy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }
}
