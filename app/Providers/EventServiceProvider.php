<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\ShopChangedEvent' => [
            'App\Listeners\UpdateShopEarningTableListener',
            'App\Listeners\ChangeClientRoleToManager',
        ],
        'App\Events\OrderChangedEvent' => [
            'App\Listeners\UpdateOrderEarningTable',
            'App\Listeners\UpdateOrderDriverTable'
        ],
        'App\Events\OrderConfirmationEvent' => [
            'App\Listeners\OrderConfirmationListeners',
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
