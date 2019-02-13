<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Http\Controllers\MailController;


use App\Order;
use App\OrderItem;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Auth;
use View;
use PDF;
use Mail;
use App\Config;
use App\Jobs\SaveNewOrder;



class SaveNewOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $data;
    protected $list;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data,$list)
    {
        $this->data = $data;
        $this->list = $list;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $data = $this->data;
        $list = $this->list;

        $order = Order::create($data);

        $list = json_decode($list);

        foreach($list as $item)
        {
            OrderItem::create([
                'order_id'=>$order->id,
                'product_id' => $item->id,
                'code'=>$item->code,
                'name'=>$item->name,
                'price'=>$item->price,
                'qty'=>$item->units,
            ]);
        }

       if($order->mail){
           MailController::mailOrderToClient($order);
        }
    }
}
