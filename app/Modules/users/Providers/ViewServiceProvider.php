<?php

namespace Users\Providers;
use Users\Models\Permissions;
use Users\Models\Role;
use Illuminate\Support\ServiceProvider;
use View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['users::roles.fields'], function ($view) {
            $allPermissions = Permissions::all();
            $view->with('allPermissions', $allPermissions);
        });
        View::composer(['users::users.role_field'], function ($view) {
            $roles = Role::pluck('name','id')->toArray();
            $view->with('roles', $roles);
        });
    }
}
