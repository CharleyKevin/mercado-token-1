<?php

namespace App\Services\Api;

use Auth;
use Illuminate\Support\Collection;

class OrderMailService implements OrderMailInterface
{

    public function sendMailCustomer(Collection $mails): bool
    {
        // TODO: Implement sendMailCustomer() method.
    }

    public function sendMailSeller(Collection $mails): bool
    {
        // TODO: Implement sendMailSeller() method.
    }
}
