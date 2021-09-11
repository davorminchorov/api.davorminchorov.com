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
            'api_routes_path' => 'app/Framework/Routes/api.php',
            'api_prefix' => 'v1',
            'api_route_name_prefix' => 'v1.framework.',
            'api_middleware' => ['api'],
            'api_namespace' => 'DavorMinchorov\Framework\Api\V1\Controllers',
        ],
        'authentication' => [
            'name' => 'Authentication',
            'api_routes_path' => 'app/Authentication/Routes/api.php',
            'api_prefix' => 'v1/authentication',
            'api_route_name_prefix' => 'v1.authentication.',
            'api_middleware' => ['api'],
            'api_namespace' => 'DavorMinchorov\Authentication\Api\V1\Controllers',
        ],
        'users' => [
            'name' => 'Users',
            'api_routes_path' => 'app/Users/Routes/api.php',
            'api_prefix' => 'v1/users',
            'api_route_name_prefix' => 'v1.users.',
            'api_middleware' => ['api'],
            'api_namespace' => 'DavorMinchorov\Users\Api\V1\Controllers',
        ],

        'personalAccessTokens' => [
            'name' => 'PersonalAccessTokens',
            'api_routes_path' => 'app/PersonalAccessTokens/Routes/api.php',
            'api_prefix' => 'v1/personalAccessTokens',
            'api_route_name_prefix' => 'v1.personalAccessTokens.',
            'api_middleware' => ['api'],
            'api_namespace' => 'DavorMinchorov\PersonalAccessTokens\Api\V1\Controllers',
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
                Route::prefix($module['api_prefix'])
                    ->middleware($module['api_middleware'])
                    ->namespace($module['api_namespace'])
                    ->name($module['api_route_name_prefix'])
                    ->group(base_path($module['api_routes_path']));
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
