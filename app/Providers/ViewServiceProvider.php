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
        // Bind $department to the layout
        View::composer('layouts.admin-master-layout.blade', function ($view) {
            $view->with('department', optional(auth()->user())->name);
            // $view->with('department', optional(auth()->user()->department)->code);

        });
    }
}
