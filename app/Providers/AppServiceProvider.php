<?php

namespace App\Providers;

use App\FormFields\CityFormField;
use Illuminate\Support\ServiceProvider;
use TCG\Voyager\Facades\Voyager;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Voyager::addFormField(CityFormField::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Voyager::addAction(\App\Actions\AdminUserAction::class);
        Voyager::addAction(\App\Actions\BlockUserAction::class);
    }
}
