<?php

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;


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

// Route::get('/', function () {
//     return response('<div>Welcome to api server</div>');
// });


Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear'); 
    return "Cleared!"; 
 });



//  Route::post('/user_loginmidleweare', [LoginController::class, 'user_loginmidleweare'])->middleware('textfileadd');
 

 Route::middleware('tokenscheck')->prefix('api')->group(function () {
    Route::get('/check', [LoginController::class, 'check']);


    
});