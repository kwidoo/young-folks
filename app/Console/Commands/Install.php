<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'yf:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initial installation of the application';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Installing the application...');
        $this->call('migrate:fresh');
        $this->call('db:seed');
        $this->call('nova:install');
        $this->call('storage:link');
        $this->info('Application installed successfully!');
        return 0;
    }
}
