<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $emailDataName="amanbihal98@gmail.com";
        $details=[
            'email' => 'PSIEC ADMIN PANEL',
            'body' => 'Congratulations!!! Your order has been deleivered',
        ];
        \Mail::to($emailDataName)->send(new \App\Mail\PSIECMail($details));

    }
}
