<?php

namespace App\Services\Api;

use App\Models\CustomerOrder;
use App\Models\Products;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;


class CustomerOrderService implements CustomerOrderInterface
{
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
        $user = User::find($request['user_id']);

        // image user is very similar then image face
        // $request['base_picture'] = $request['picture']

        return true;
    }

    public function validateCustomerOrders(string $uuid): CustomerOrder
    {
        $payment_transaction = 'dgbkfmgbjgbrovmev';
        $token_transaction = 'dmvkfbnfjkbngfbmdlkbmel';

        $customerOrder = CustomerOrder::where('uuid', $uuid)->first();

        if (empty($customerOrder)) return $customerOrder;

        CustomerOrder::where('uuid', $uuid)->update([
            'payment_transaction' => $payment_transaction,
            'token_transaction' => $token_transaction
        ]);

        return CustomerOrder::where('uuid', $uuid)->get()->first();
    }
}
