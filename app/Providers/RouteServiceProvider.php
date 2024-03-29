<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api/v1')
                ->as('api.v1.')
                ->group(function () {
                    require base_path('routes/api/v1/user.php');
                    require base_path('routes/api/v1/role.php');
                    require base_path('routes/api/v1/permission.php');
                    require base_path('routes/api/v1/student.php');
                    require base_path('routes/api/v1/dormitory.php');
                    require base_path('/routes/api/v1/gender.php');
                    require base_path('/routes/api/v1/country.php');
                    require base_path('/routes/api/v1/academicGroup.php');
                    require base_path('/routes/api/v1/settlementHistory.php');
                });

            Route::middleware('web')
                ->prefix('spa/v1')
                ->as('spa.v1.')
                ->group(base_path('routes/spa.php'));
        });
    }
}
