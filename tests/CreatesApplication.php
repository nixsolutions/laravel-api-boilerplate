<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Artisan;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        $currentEnv = array_filter($_SERVER['argv'], function ($arg) {
            if (strrpos($arg, '--env=') !== false) {
                return true;
            }
        });

        $env = 'testing';

        if (!empty($currentEnv)) {
            $env = str_replace('--env=', '', current($currentEnv));
        } else {
            $app->loadEnvironmentFrom('.env.' . $env);
        }

        $app->loadEnvironmentFrom('.env.' . $env);

        Artisan::call('migrate');
        Artisan::call('db:seed');
        Artisan::call('cache:clear');

        return $app;
    }
}
