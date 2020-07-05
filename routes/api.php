<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/payment', function (Request $request) {
    return response()->json(['transaction_id' => '12frkejh2343fkfbnjkf', 'verification' => true, 'status' => 'true' ]);
});

Route::post('/token-validation', function (Request $request) {
    return response()->json(['status' => 'false', 'verification' => 'false']);
});

Route::post('/sms-token', function (Request $request) {
    return response()->json(['status' => 'true', 'verification' => 'false']);
});

Route::post('/sms-token', function (Request $request) {
    return response()->json(['status' => 'true', 'verification' => 'false']);
});

Route::get("/customer-orders", ["as" => "api.customer.orders", "uses" => "Api\CustomerOrderController@getCustomerOrders"]);
