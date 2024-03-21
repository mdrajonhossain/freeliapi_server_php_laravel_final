<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




// Register stysemt start
Route::post('/user_register', [LoginController::class, 'userregister']);
// Register stysemt End






// Login stysemt start
Route::post('/user_login', [LoginController::class, 'login']);





// Login stysemt End



Route::post('/user_loginmidleweare', [LoginController::class, 'user_loginmidleweare'])->middleware('textfileadd');