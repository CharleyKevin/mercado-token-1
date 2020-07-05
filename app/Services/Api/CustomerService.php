<?php

namespace App\Services\Api;

use App\Models\CustomerOrder;
use App\Models\Products;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use SebastianBergmann\Environment\Console;
use Symfony\Component\Console\Logger\ConsoleLogger;


class CustomerService implements CustomerInterface
{
    public function verifiedCustomer(int $userId) : bool
    {
        $userVerified = User::where('id', $userId)->where('verified', true)->get();

        if ($userVerified->count() > 0) return true;

        return false;
    }

    public function updateCustomer(Request $request, string $pathPicture)
    {
        $user = User::find($request['user_id']);

        if (empty($user)) return null;

        $user->base_picture = $pathPicture;
        $user->save();

        if ($user->wasChanged('base_picture')) return User::find($request['user_id']);

        return null;
    }

    public function getCustomer(int $userId): User
    {
        // TODO: Implement getCustomer() method.
        return User::find($userId);
    }
}
