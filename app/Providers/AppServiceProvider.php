<?php

namespace App\Providers;

use App\Lib\Handlers\AppUninstalled;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Shopify\Auth\FileSessionStorage;
use Shopify\Context;
use Shopify\Webhooks\Registry;
use Shopify\Webhooks\Topics;

class AppServiceProvider extends ServiceProvider
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
     * @throws \Shopify\Exception\MissingArgumentException
     */
    public function boot()
    {
        Context::initialize(
            Config::get('shopify.api_key'),
            Config::get('shopify.secret_key'),
            implode(',', config('shopify.scopes')),
            str_replace('https://', '', Config::get('shopify.app_url')),
            new FileSessionStorage('/tmp/php_sessions'),
        );

        URL::forceScheme('https');

        Registry::addHandler(Topics::APP_UNINSTALLED, new AppUninstalled());
    }
}
