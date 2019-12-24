<?php

namespace nobaar\findaddress\Tests\Unit;



use nobaar\findaddress\Tests\TestCase;
use nobaar\findaddress\Models\MapProviders;

class ProvidersTest extends TestCase
{
    
    
    /** @test */
    public function a_provider_can_be_add(){
        dd(new MapProviders());
        $mapProvider = MapProviders::create([
            'name' => 'nesahn',
        ]);
        $this->assertEquals('neshan', $mapProvider->name);
    }    
}