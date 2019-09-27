<?php

namespace App\Console\Commands;

use App\UserLoginToken;
use Illuminate\Console\Command;

class ClearExpiredToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will clear all the expired tokens';

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
        UserLoginToken::Expired()->delete();
        $this->info("Expired tokens deleted successfully"); 
    }
}
