<?php

namespace DavorMinchorov\Framework\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected array $modules = [
        'framework' => [
            'name' => 'Framework',
            'path' => 'app/Framework/Routes/api.php',
            'prefix' => 'v1',
            'middleware' => ['api'],
            'namespace' => 'DavorMinchorov\Framework\Api\V1\Controllers',
        ],
        'authentication' => [
            'name' => 'Authentication',
            'path' => 'app/Authentication/Routes/api.php',
            'prefix' => 'v1/authentication',
            'middleware' => ['api'],
            'namespace' => 'DavorMinchorov\Authentication\Api\V1\Controllers',
        ],
        'users' => [
            'name' => 'Users',
            'path' => 'app/Users/Routes/api.php',
            'prefix' => 'v1/users',
            'middleware' => ['api'],
            'namespace' => 'DavorMinchorov\Users\Api\V1\Controllers',
        ],
    ];

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            collect($this->modules)->map(function ($module) {
                Route::prefix($module['prefix'])
                    ->middleware($module['middleware'])
                    ->namespace($module['namespace'])
                    ->group(base_path($module['path']));
            });
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
