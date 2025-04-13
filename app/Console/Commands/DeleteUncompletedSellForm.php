<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\SellCar;
use Mail;
class DeleteUncompletedSellForm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:deleteuncompleted';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Note: Sell car deleted!';

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
         \Log::info("Cron is resturant is closed !");

        $resturants = Resturant::where('status','!=','disabled')->where('close_at', now()->format('H:i'))->get();
                // \Log::info($resturants);
        foreach ($resturants as $resturant) {
            // if (now()->format('H:i') === $resturant->close_at) {
                // Generate daily report here
                $to_email = $resturant->user?->email;
                if($to_email){
                    $orders =Order::where('resturant_id',$resturant->id)->where('type','!=','wallet')->where('status','completed')->whereDay('created_at', now()->day)->get();
                    if($orders->count() > 0){
                    try{
                        $mail=Mail::send('emails.send_daily_vendor_orders', ['orders' => $orders, 'vendor' => $resturant->user], function($message) use ( $to_email) {
                             $message->to($to_email);
                             $message->subject("today's report");
                        });
                    } catch (\Exception $e) {
    
                        return $e->getMessage();
                    }
                    }
                }
            // }
        }
        
//        return 0;
    }
}
