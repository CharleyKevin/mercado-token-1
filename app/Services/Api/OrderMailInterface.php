<?php

namespace App\Services\Api;

use Auth;
use Illuminate\Support\Collection;


interface OrderMailInterface
{
    /**
     * @param Collection $mails
     * @return bool
     */
    public function sendMailCustomer(Collection $mails) : bool;
    public function sendMailSeller(Collection $mails) : bool;
}
