<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    private function registerBindings()
    {
        $this->app->bind(
            'App\Repositories\ShopRepository',
            function () {
                $repository = new \App\Repositories\Eloquents\EloquentShopRepository(new \App\Models\Shop());
                return $repository;
            }
        );
    }
}
