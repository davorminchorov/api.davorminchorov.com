<?php

namespace DavorMinchorov\Framework\Providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class ModelFactoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        Factory::guessFactoryNamesUsing(function (string $modelName) {
            $moduleName = explode('\\', $modelName)[1];
            $namespace = "DavorMinchorov\\{$moduleName}\\Factories\\";
            $modelName = Str::afterLast($modelName, '\\');

            return $namespace.$modelName.'Factory';
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
