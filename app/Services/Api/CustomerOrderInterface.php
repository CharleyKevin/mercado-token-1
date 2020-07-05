<?php

namespace App\Services\Api;

use Auth;
use Illuminate\Support\Collection;


interface CustomerOrderInterface
{
    /**
     * @return Collection
     */
    public function getCustomerOrders() : Collection;
}
