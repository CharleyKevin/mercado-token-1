<?php

namespace App\Services\Api;

use App\Models\CustomerOrder;
use App\Models\Products;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;


class CustomerService implements CustomerInterface
{
    public function verifiedCustomer(int $userId) : bool
    {
        $userVerified = User::where('id', $userId)->where('verified', true)->get();

        if ($userVerified->count() > 0) return true;

        return false;
    }

    public function updateCustomer(Request $request)
    {
        $user = User::find($request['user_id']);

        if (empty($user)) return null;

        return $user->update(['base_picture' => $request['base_picture']]);
    }
}
