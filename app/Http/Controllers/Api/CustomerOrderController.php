<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\CustomerOrderInterface;

class CustomerOrderController extends Controller
{
    /**
     * @var CustomerOrderInterface
     */
    private $customerOrderInterface;

    /**
     * CustomerOrderController constructor.
     * @param CustomerOrderInterface $customerOrderInterface
     */
    public function __construct(CustomerOrderInterface $customerOrderInterface)
    {
        $this->customerOrderInterface = $customerOrderInterface;
    }

    public function getCustomerOrderList()
    {
        return $this->customerOrderInterface->getCustomerOrders();
    }
}
