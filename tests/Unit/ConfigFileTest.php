<?php

namespace nobaar\findaddress\Tests\Unit;


use Illuminate\Support\Facades\File;
use nobaar\findaddress\Tests\TestCase;

class ConfigFileTest extends TestCase
{
    /** @test */
    public function the_install_command_copies_the_configuration(){
        if (File::exists(config_path('findaddress.php'))) {
            unlink(config_path('findaddress.php'));
        }
            
        $this->assertFalse(File::exists(config_path('findaddress.php')));
            
        $this->artisan('vendor:publish', [
            "--provider" => "nobaar\\findaddress\\FindAddressServiceProvider",
            "--tag" => "config"
        ]);
        
        File::exists(config_path('findaddress.php'));

        $this->assertTrue(File::exists(config_path('findaddress.php')));
    }    
}