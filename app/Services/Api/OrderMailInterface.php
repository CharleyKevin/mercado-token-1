<?php

namespace App\Services\Api;

use Auth;
use Illuminate\Support\Collection;


interface OrderMailInterface
{
    /**
     * @param Collection $mails
     * @return Collection
     */
    public function sendMail(Collection $mails) : Collection;
}
