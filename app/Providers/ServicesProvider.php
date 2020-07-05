<?php

namespace App\Providers;

use App\Services\Api\CustomerInterface;
use App\Services\Api\CustomerOrderInterface;
use App\Services\Api\CustomerOrderService;
use App\Services\Api\CustomerService;
use App\Services\Api\OrderMailInterface;
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
        $this->app->bind(CustomerInterface::class, CustomerService::class);
        $this->app->bind(OrderMailInterface::class, OrderMailService::class);
    }
}
