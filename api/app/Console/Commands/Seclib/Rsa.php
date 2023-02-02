<?php

namespace App\Console\Commands\Seclib;

use Illuminate\Console\Command;
use App\Libs\Seclib;

class Rsa extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:rsa';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate RSA (public,private) keys using phpseclib.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        echo Seclib::execute();
    }
}
