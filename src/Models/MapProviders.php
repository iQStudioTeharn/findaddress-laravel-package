<?php

namespace nobaar\findaddress\Models;

use Illuminate\Database\Eloquent\Model;

class MapProviders extends Model
{
  // Disable Laravel's mass assignment protection
  protected $table = 'map_providers';
  protected $guarded = [];
}