<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCustomerOrdersRequest;
use App\Services\Api\CustomerInterface;
use App\Services\Api\CustomerOrderInterface;
use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{
    /**
     * @var CustomerInterface
     * @var CustomerOrderInterface
     */
    private $customerInterface;
    private $customerOrderInterface;

    /**
     * CustomerOrderController constructor.
     * @param CustomerInterface $customerInterface
     * @param CustomerOrderInterface $customerOrderInterface
     */
    public function __construct(CustomerInterface $customerInterface, CustomerOrderInterface $customerOrderInterface)
    {
        $this->customerInterface = $customerInterface;
        $this->customerOrderInterface = $customerOrderInterface;
    }

    public function getCustomerOrders()
    {
        return $this->customerOrderInterface->getCustomerOrders();
    }

    public function createCustomerOrders(CreateCustomerOrdersRequest $request)
    {
        if ($request['type_payment'] == 2) {

            $verifiedCustomer = $this->customerInterface->verifiedCustomer($request['customer_id']);

            $customerOrder = $this->customerOrderInterface->createCustomerOrders($request);

            return response()->json([
                "payment_transaction" => $customerOrder['uuid'],
                "type_payment" => $customerOrder['type_payment'],
                "verification" => $verifiedCustomer,
                "status_order" => "created"
            ]);

        }

        return response()->json(["status_order" => "method not allowed"],403);
    }

    public function validateFirstCustomerOrder(Request $request)
    {
        $userUpdate = $this->customerInterface->updateCustomer($request);

        if (!$userUpdate) {
            return response()->json([
                "payment_transaction" => $request['payment_transaction'],
                "token_transaction" => "",
                "verification" => false,
            ]);
        }

        $verification = $this->customerOrderInterface->verifiedCustomerOrders($request);

        if ($verification) {

            $customerOrder = $this->customerOrderInterface->validateCustomerOrders($request['payment_transaction']);

            return response()->json([
                "payment_transaction" => $customerOrder['uuid'],
                "token_transaction" => $customerOrder['token_transaction'],
                "verification" => $verification,
            ]);
        }

        return response()->json([
            "payment_transaction" => $request['payment_transaction'],
            "token_transaction" => "",
            "verification" => $verification,
        ]);
    }

    public function validateCustomerOrder(Request $request)
    {
        $verification = $this->customerOrderInterface->verifiedCustomerOrders($request);

        if ($verification){
            $customerOrder = $this->customerOrderInterface->validateCustomerOrders($request['payment_transaction']);

            return response()->json([
                "payment_transaction" => $customerOrder['uuid'],
                "token_transaction" => $customerOrder['token_transaction'],
                "verification" => $verification,
            ]);
        }

        return response()->json([
            "payment_transaction" => $request['payment_transaction'],
            "token_transaction" => "",
            "verification" => $verification,
        ]);
    }
}
