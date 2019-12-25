<?php

namespace nobaar\findaddress\Tests\Unit;



use nobaar\findaddress\Tests\TestCase;
use nobaar\findaddress\Models\MapProviders;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use nobaar\findaddress\Finder;

class ProvidersTest extends TestCase 
{
    // use RefreshDatabase;
    /** @test */
    public function a_provider_can_be_add($name = 'neshan'){
        // dd((Schema::hasTable('map_providers')));
        if(MapProviders::where('name',$name)->count() == 0){
            $mapProvider = MapProviders::create([
                'name' => $name,
            ]);
            $this->assertEquals($name, $mapProvider->name);

        }else{
            $this->assertTrue(true);
        }
    }  
    /** @test */
    public function get_address_of_a_given_lat_an_long(){
        $finder = new Finder();
        $this->assertEquals($finder->getAddress(35.737847,51.3773133)->status, 'OK');
    }
}