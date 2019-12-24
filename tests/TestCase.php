<?php

namespace nobaar\findaddress\Tests;


use nobaar\findaddress\FindAddressServiceProvider;
// use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
class TestCase extends \Orchestra\Testbench\TestCase
{
    // use DatabaseMigrations;
    use RefreshDatabase;
    public function setUp(): void
    {
      parent::setUp();
      // additional setup
      
    }
  
    protected function getPackageProviders($app)
    {
      return [
        FindAddressServiceProvider::class,
      ];
    }
  
    /**
     * Define environment setup.
     *
     * @param  Illuminate\Foundation\Application  $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
      
      // import the CreateMapProvidersTable class from the migration
      include_once __DIR__ . '/../src/database/migrations/create_map_providers_table.php';
      // run the up() method of that migration class
      (new \CreateMapProvidersTable)->up();
    }

  }