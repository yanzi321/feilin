<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    protected $adminNamespace = 'App\Http\Controllers\Admin';
    protected $pcNamespace = 'App\Http\Controllers\Pc';
    protected $miniNamespace = 'App\Http\Controllers\Mini';
    protected $adminV2Namespace = 'App\Http\Controllers\AdminV2';
    protected $frontendV2Namespace = 'App\Http\Controllers\FrontendV2';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapAdminRouters();

        $this->mapPcRouters();

        $this->mapMiniRouters();

        $this->mapWebRoutes();

        $this->mapAdminV2Routers();

        $this->mapFrontendV2Routers();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    protected function mapAdminRouters()
    {
        Route::prefix('api/admin')
            ->middleware('api')
            ->namespace($this->adminNamespace)
            ->group(base_path('routes/admin.php'));
    }

    protected function mapPcRouters()
    {
        Route::prefix('api/pc')
            ->middleware('api')
            ->namespace($this->pcNamespace)
            ->group(base_path('routes/pc.php'));
    }

    /**
     * 小程序相关路由
     */
    protected function mapMiniRouters()
    {
        Route::prefix('api/mini')
            ->middleware('api')
            ->namespace($this->miniNamespace)
            ->group(base_path('routes/mini.php'));
    }

    protected function mapAdminV2Routers()
    {
        Route::prefix('api/adminV2')
            ->middleware('api')
            ->namespace($this->adminV2Namespace)
            ->group(base_path('routes/adminV2.php'));
    }

    protected function mapFrontendV2Routers()
    {
        Route::prefix('api/frontendV2')
            ->middleware('api')
            ->namespace($this->frontendV2Namespace)
            ->group(base_path('routes/frontendV2.php'));
    }
}
