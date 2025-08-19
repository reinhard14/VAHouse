<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //add adminDepartment to "Dashboard" view.
        View::composer(
            ['layouts.admin-master-layout', 'index'],
            function ($view) {
                $view->with('adminDepartment', optional(auth()->user()->administrator)->department);
            }
        );
    }
}
