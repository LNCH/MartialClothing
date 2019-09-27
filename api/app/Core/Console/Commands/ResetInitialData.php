<?php

namespace App\Core\Console\Commands;

use Illuminate\Console\Command;

class ResetInitialData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset-initial-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resets the database to it\'s initial test data.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('migrate:fresh', ['--seed' => true, '--drop-views' => true]);
    }
}
