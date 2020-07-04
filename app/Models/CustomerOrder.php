<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class User extends Model
{
    use Uuids;

    protected $fillable = [
        'name_product',
        'value_transaction',
        'type_payment',
        'payment_transaction',
        'token_transaction',
    ];
}
