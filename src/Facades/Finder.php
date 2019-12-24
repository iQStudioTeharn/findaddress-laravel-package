<?php

namespace nobaar\findaddress\Facades;

use Illuminate\Support\Facades\Facade;

class Finder extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'finder';
    }
}