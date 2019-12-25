<?php

namespace nobaar\findaddress;

use Illuminate\Support\Facades\File;
use nobaar\findaddress\Models\MapProviders;
use GuzzleHttp\Client;

class Finder
{
    public $confProviders;
    public $dbProviders;
    public $lat;
    public $long;
    public $selectedProvider;

    public function __construct()
    {
        $this->confProviders = config('findaddress.proveiders');
        $this->dbProviders = MapProviders::pluck('name')->toArray();
    }

    public function getAddress($lat, $long)
    {
        $this->lat = $lat;
        $this->long = $long;
        return $this->Address();
        
    }



    public function Address(){
        $this->selectedProvider = $this->provider();
        $token = $this->confProviders[$this->selectedProvider->name]['token'];
        $api = $this->confProviders[$this->selectedProvider->name]['api'];
        $client = new Client();
        $response = $client->request('GET', $api . '?lat=' . $this->lat . '&lng=' . $this->long , [
            'headers' => [
                'Api-Key' => $token,
                'Accept'     => 'application/json',
        ]]);

        if($response->getStatusCode() == 200){
            $this->providerLog();
        }else{
           return false;
        }
        $address  = json_decode($response->getBody()->getContents());
        return $address; 

    }

    public function provider()
    {
        return $this->checkConfigFile();
    }


    public function checkConfigFile()
    {

        if (File::exists(config_path('findaddress.php'))) {

            return $this->sync();
        }
        return false;
    }

    public function sync()
    {
        foreach ($this->dbProviders as $key => $dp) {
            # code...
            if (!isset($this->confProviders[$dp])){
                $this->deleteProvider($dp);
            }
        }

        foreach ($this->confProviders as $name => $data) {
            # code...
            if (!in_array($name, $this->dbProviders)) {
                $this->addProvider($name);
            }
        }
        
        return MapProviders::orderBy('count','asc')->get()->first();
    }

    public function addProvider($name)
    {
        MapProviders::create([
            'name' => $name
        ]);
    }
    public function deleteProvider($name)
    {
        MapProviders::where('name' , $name)->delete();
    }

    public function providerLog(){
        $this->selectedProvider->count++;
        $this->selectedProvider->save();
    }
}
