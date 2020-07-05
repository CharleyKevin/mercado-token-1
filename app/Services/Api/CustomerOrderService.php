<?php

namespace App\Services\Api;

use App\Models\CustomerOrder;
use App\Models\Products;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Webpatser\Uuid\Uuid;


class CustomerOrderService implements CustomerOrderInterface
{
    /**
     * @var FaceMatchInterface
     */
    private $faceMatchInterface;

    public function __construct(FaceMatchInterface $faceMatchInterface)
    {
        $this->faceMatchInterface = $faceMatchInterface;
    }

    public function getCustomerOrders(): Collection
    {
        return CustomerOrder::all();
    }

    public function getCustomerOrdersByUserId(int $uuid): Collection
    {
        return CustomerOrder::where('uuid', $uuid)->get();
    }

    public function createCustomerOrders(Request $request): CustomerOrder
    {
        $customer = new CustomerOrder;
        $customer->customer_id = $request->customer_id;
        $customer->seller_id = $request->seller_id;
        $customer->name_product = $request->name_product;
        $customer->name_customer = $request->customer_id;
        $customer->value_transaction = $request->value_transaction;
        $customer->type_payment = $request->type_payment;

        $customer->save();

        return $customer;
    }

    public function verifiedCustomerOrders(Request $request): bool
    {
        $user = User::find((isset($request['user_id'])) ? $request['user_id'] : 1);

        if ($user->count() < 1) return false;

        return $user;

        return $this->faceMatchInterface->validateFaceWithBase($user['base_picture'],$request->file('selfie'));
    }

    public function validateCustomerOrders(string $uuid): CustomerOrder
    {
        $payment_transaction = Uuid::generate();
        $token_transaction = Uuid::generate();

        $customerOrder = CustomerOrder::where('uuid', $uuid)->first();

        if (empty($customerOrder)) return $customerOrder;

        CustomerOrder::where('uuid', $uuid)->update([
            'payment_transaction' => $payment_transaction,
            'token_transaction' => $token_transaction
        ]);

        return CustomerOrder::where('uuid', $uuid)->get()->first();
    }
}
