<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCustomerOrdersRequest;
use App\Services\Api\CustomerInterface;
use App\Services\Api\CustomerOrderInterface;
use App\Services\Api\OrderMailInterface;
use App\Services\Api\SellerInterface;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;

class CustomerOrderController extends Controller
{
    /**
     * @var CustomerInterface
     * @var CustomerOrderInterface
     * @var OrderMailInterface
     */
    private $customerInterface;
    private $customerOrderInterface;
    private $orderMailInterface;
    private $sellerInterface;

    /**
     * CustomerOrderController constructor.
     * @param CustomerInterface $customerInterface
     * @param CustomerOrderInterface $customerOrderInterface
     * @param OrderMailInterface $orderMailInterface
     * @param SellerInterface $sellerInterface
     */
    public function __construct(
        CustomerInterface $customerInterface,
        CustomerOrderInterface $customerOrderInterface,
        OrderMailInterface $orderMailInterface,
        SellerInterface $sellerInterface
    )
    {
        $this->customerInterface = $customerInterface;
        $this->customerOrderInterface = $customerOrderInterface;
        $this->orderMailInterface = $orderMailInterface;
        $this->sellerInterface = $sellerInterface;
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
        return response()->json([
            'token_transaction' => 's9d8as9das89dj'
        ], 200);

//        $basePicture = $request->file('base_picture');
//
//        $pathPicture = $basePicture->store('base_picture','local');
//
//        $customer = $this->customerInterface->updateCustomer($request, $pathPicture);
//
//        if ($customer == null) {
//            return response()->json([
//                "payment_transaction" => $request['payment_transaction'],
//                "token_transaction" => "",
//                "verification" => false,
//            ]);
//        }
//
//        $verification = $this->customerOrderInterface->verifiedCustomerOrders($request);
//
//        if ($verification) {
//
//            $customerOrder = $this->customerOrderInterface->validateCustomerOrders($request['payment_transaction']);
//
//            $seller = $this->sellerInterface->getSeller($customerOrder['seller_id']);
//
//            $this->orderMailInterface->sendMailCustomer($customer->toArray(),$customerOrder['token_transaction']);
//            $this->orderMailInterface->sendMailSeller($seller->toArray(),$customerOrder['token_transaction']);
//
//            return response()->json([
//                "payment_transaction" => $customerOrder['uuid'],
//                "token_transaction" => $customerOrder['token_transaction'],
//                "verification" => $verification,
//            ]);
//        }
//
//        return response()->json([
//            "payment_transaction" => $request['payment_transaction'],
//            "token_transaction" => "",
//            "verification" => $verification,
//        ]);
    }

    public function validateCustomerOrder(Request $request)
    {
        return response()->json([
            'token_transaction' => 's9d8as9das89dj'
        ], 200);

//        try {
//            $verification = $this->customerOrderInterface->verifiedCustomerOrders($request);
//
//            if ($verification) {
//                $customerOrder = $this->customerOrderInterface->validateCustomerOrders($request['payment_transaction']);
//
//                $seller = $this->sellerInterface->getSeller($customerOrder['seller_id']);
//
//                $this->orderMailInterface->sendMailCustomer($customer->toArray(),$customerOrder['token_transaction']);
//                $this->orderMailInterface->sendMailSeller($seller->toArray(),$customerOrder['token_transaction']);
//
//                return response()->json([
//                    "payment_transaction" => $customerOrder['uuid'],
//                    "token_transaction" => $customerOrder['token_transaction'],
//                    "verification" => $verification,
//                ]);
//            }
//
//            return response()->json([
//                "payment_transaction" => $request['payment_transaction'],
//                "token_transaction" => "",
//                "verification" => $verification,
//            ]);
//        }catch (\Throwable $exception){
//            return response()->json([
//                "payment_transaction" => "",
//                "token_transaction" => "",
//                "verification" => "",
//            ],500);
//        }
    }
}
