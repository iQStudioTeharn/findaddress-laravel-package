<?php

namespace Bitfumes\Contact;

use Illuminate\Support\ServiceProvider;

class FindAddressServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/findaddress.php',
            'contact'
        );
        $this->publishes([
            __DIR__ . '/config/findaddress.php' => config_path('findaddress.php')
        ]);
    }

    public function register()
    {
    }
}
