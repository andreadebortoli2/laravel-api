<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Mail\PortfolioContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Mail\PortfolioContact;
use App\Models\Contact;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('projects', [ProjectController::class, 'index']);
Route::get('projects/{project:slug}', [ProjectController::class, 'show']);

// remember to remove before the productio phase
Route::get('mailable', function () {

    $data = Contact::all()->last();
    // dd($data);

    return new App\Mail\PortfolioContact($data);
});

Route::post('contacts', [PortfolioContactController::class, 'store']);
