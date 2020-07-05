<?php

namespace App\Services\Api;

use App\Models\CustomerOrder;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;


interface CustomerInterface
{
    /**
     * @param Request $request
     * @return Collection
     */
    public function updateCustomer(Request $request);
    public function verifiedCustomer(int $userId) : bool;
}
