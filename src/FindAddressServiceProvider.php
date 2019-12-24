<?php

namespace nobaar\findaddress;

use Illuminate\Support\ServiceProvider;
use nobaar\findaddress\Console\InstallFinderPackage;

class FindAddressServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->commands([
                InstallFinderPackage::class,
            ]);

            $this->publishes([
              __DIR__.'/../config/config.php' =>   config_path('findaddress.php'),
            ], 'config');

            
        
          }
          if (! class_exists('CreateMapProvidersTable')) {
            $this->publishes([
              __DIR__ . '/../database/migrations/create_map_providers_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_map_providers_table.php'),
              // you can add any number of migrations here
            ], 'migrations');
          }
    }

    public function register()
    {
        $this->app->bind('Finder', function($app) {
            return new Finder();
        });
        
        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php',
            'findaddress'
        );
    }
}
