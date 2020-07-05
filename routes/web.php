<?php

use App\Jobs\CustomerSendNotificationOrderCompletedEmailJob;
use App\Mail\SellerNotificationOrderCompleted;
use Illuminate\Support\Facades\Route;
use App\Jobs\SellerSendNotificationOrderCompletedEmailJob;
use App\Mail\CustomerNotificationOrderCompleted;
use Webpatser\Uuid\Uuid;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/teste/mail-seller', function () {
    $user['name'] = "João Silva";
    $user['email'] = "mercadotokenvendedor@gmail.com";
    $token = Uuid::generate();

    dispatch(new SellerSendNotificationOrderCompletedEmailJob($user, $token))
        ->delay(now());
});
Route::get('/teste/mail-customer', function () {

    $user['name'] = "Fabio Rocha";
    $user['email'] = "mercadotokencomprador@gmail.com";
    $token = Uuid::generate();

    dispatch(new CustomerSendNotificationOrderCompletedEmailJob($user, $token))
        ->delay(now());
});
Route::get('/teste/mail-seller-view', function () {

    $user['name'] = "João Silva";
    $user['email'] = "mercadotokenvendedor@gmail.com";
    $token = Uuid::generate();

    return new SellerNotificationOrderCompleted($user, $token);
});
Route::get('/teste/mail-customer-view', function () {

    $user['name'] = "Fabio Rocha";
    $user['email'] = "mercadotokencomprador@gmail.com";

    $token = Uuid::generate();

    return new CustomerNotificationOrderCompleted($user, $token);
});
