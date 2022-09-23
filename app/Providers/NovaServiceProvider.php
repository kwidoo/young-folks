<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Itsmejoshua\Novaspatiepermissions\Novaspatiepermissions;
use App\Nova\Dashboards\Main;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Laravel\Nova\Menu\Menu;
use Laravel\Nova\Menu\MenuItem;
use Stepanenko3\NovaSettings\NovaSettingsTool;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::footer(function ($request) {
            return Blade::render('
                @env(\'local\')
                    This is production!
                @endenv
            ');
        });

        if (request()->user() !== null) {
            app()->setLocale(request()->user()->locale);
        }

        Nova::userMenu(function (Request $request, Menu $menu) {
            if ($request->user() === null) {
                return $menu;
            }
            //@todo add languages here by adding new vue component
            $menu->prepend(
                MenuItem::make(
                    __('My Profile'),
                    "/resources/users/{$request->user()->getKey()}"
                )
            );

            return $menu;
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                'oleg@pashkovsky.me',
                'janovskajana@inbox.lv',
                'info@youngfolks.lv'
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            Novaspatiepermissions::make()->canSee(function ($request) {
                if ($request->user() === null) {
                    return false;
                }
                return $request->user()->hasAnyRole('SuperAdmin', 'Admin');
            }),
            NovaSettingsTool::make(),
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
