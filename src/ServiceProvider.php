<?php

namespace Cblink\Seeder;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

/**
 * Class ServiceProvider
 * @package Cblink\Seeder
 */
class ServiceProvider extends LaravelServiceProvider
{

    public function boot()
    {
        // 执行迁移
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(\dirname(__DIR__).'/migrations/');
        }
    }
}
