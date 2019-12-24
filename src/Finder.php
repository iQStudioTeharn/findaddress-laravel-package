<?php

namespace nobaar\findaddress;

class Finder
{
    private $providers;

    public function __construct()
    {
        $this->providers = config('findaddress.proveiders');
    }

    public static function getAddress($lat,$long){
        
    }

    
}