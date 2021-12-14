<?php

namespace DavorMinchorov\Framework\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Config\Repository;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            $config = $this->app->make(Repository::class);

            Collection::make($config->get('modules'))->map(function ($module) {
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
