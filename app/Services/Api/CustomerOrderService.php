<?php

namespace App\Services\Api;

use App\Models\CustomerOrder;
use Auth;
use Illuminate\Support\Collection;


class CustomerOrderService implements CustomerOrderInterface
{
    public function getCustomerOrders() : Collection
    {
        return CustomerOrder::all();
    }
}
