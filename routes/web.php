<?php

use App\Jobs\CustomerSendNotificationOrderCompletedEmailJob;
use App\Mail\SellerNotificationOrderCompleted;
use Illuminate\Support\Facades\Route;
use App\Jobs\SellerSendNotificationOrderCompletedEmailJob;
use App\Mail\CustomerNotificationOrderCompleted;
use Webpatser\Uuid\Uuid;
use Aws\Rekognition\RekognitionClient;

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
Route::get('/check-image', function () {
        $client = new RekognitionClient([
            'region'    => env('AWS_DEFAULT_REGION'),
            'version'   => 'latest'
        ]);

    $photoPerson = Storage::disk('local')->get('images/foto_fabio.jpeg');
    $photoPersonId = Storage::disk('local')->get('images/cnh_fabio.png');
    $result = $client->compareFaces([
                'QualityFilter' => 'AUTO', // NONE|AUTO|LOW|MEDIUM|HIGH
                'SourceImage' => [ // REQUIRED
                    'Bytes' => $photoPerson,
            ],
            'TargetImage' => [ // REQUIRED
                    'Bytes' => $photoPersonId,
            ],
        ]);
    $listFaceMatches = $result->get('FaceMatches');

    return view('face-match', compact('listFaceMatches'));
});
