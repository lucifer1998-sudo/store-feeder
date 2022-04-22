<?php

namespace App\Console\Commands;

use App\Models\DelayedReply;
use App\Models\Logs;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SendNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Notification to Admin';

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
     * @return int
     */
    public function handle()
    {

        $currentTime = carbon::now();
        $user = DB::table('logs')->where('id', DB::raw("(select max(`id`) from logs)"))->first();

        if( $currentTime->diffInHours($user->created_at) >= 24){
            DelayedReply::Create([
                'body' => $user->body,
                'created_by' => $user->created_by,
                'order_id' => $user->order_id
            ]);
        }



    }
}
