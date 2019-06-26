<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use PAX\Processor\CopyRecurrent;

class PostReccurrent extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recurrent:copy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy recurrent pickups for the day';

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
        //
        (new CopyRecurrent)->setTodayPickup();
    }
}
