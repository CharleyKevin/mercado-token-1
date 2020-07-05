<?php

namespace App\Providers;

use App\Services\Api\CustomerOrderInterface;
use App\Services\Api\CustomerOrderService;
use Illuminate\Support\ServiceProvider;

class ServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(CustomerOrderInterface::class, CustomerOrderService::class);
    }
}
