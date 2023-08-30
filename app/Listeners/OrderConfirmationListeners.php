<?php

namespace App\Listeners;

use App\Events\OrderConfirmationEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderConfirmationListeners
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderConfirmationEvent  $event
     * @return void
     */
    public function handle(OrderConfirmationEvent $event)
    {
        dd($event);
    }
}
