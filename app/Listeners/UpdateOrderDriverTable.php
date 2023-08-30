<?php

namespace App\Listeners;

use App\Events\OrderChangedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateOrderDriverTable
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
     * @param  OrderChangedEvent  $event
     * @return void
     */
    public function handle(OrderChangedEvent $event)
    {
        //
    }
}
