<?php

namespace nobaar\findaddress\Console;

use Illuminate\Console\Command;

class InstallFinderPackage extends Command
{
    protected $signature = 'addressfinder:install';
    
    protected $description = 'Install the Finder package';
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Installing Finder...');

        $this->info('Publishing configuration...');

        $this->call('vendor:publish', [
            '--provider' => "nobaar\findaddress\FindAddressServiceProvider",
            '--tag' => "config"
        ]);

        $this->info('Installed Finder package');
    }
}