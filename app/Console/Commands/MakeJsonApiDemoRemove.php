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
    protected $signature = 'make:demo-remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove JsonApi Demo entities';

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

    /**
     * Create a new command instance.
     *
     * @return void
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
        $this->removeJsonApiEntities();
        $this->removeModels();
        $this->removeControllers();
        $this->info('JsonApi demo entities removed successfully.');
    }

    protected function removeModels()
    {
        foreach ($this->models as $key => $value) {
            unlink(app_path('Models/' . $value));
        }
    }

    protected function removeControllers()
    {
        foreach ($this->controllers as $key => $value) {
            unlink(app_path('Http/Controllers/Api/v1/' . $value));
        }
    }

    protected function removeJsonApiEntities()
    {
        foreach ($this->jsonapiEntities as $key => $value) {
            unlink(app_path($value));
        }
        rmdir(app_path('JsonApi/Users'));
        rmdir(app_path('JsonApi/Likes'));
        rmdir(app_path('JsonApi/Skills'));
        rmdir(app_path('JsonApi/Teams'));
        rmdir(app_path('JsonApi'));
    }
}
