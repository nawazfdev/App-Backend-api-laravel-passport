<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\GroupController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\GroupInvitationController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider; and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// // });

Route::get('send-verify-email/{email}', [RegisterController::class, 'sendVerify']);
Route::post('/email-verified/{token} ', [RegisterController::class, 'emailverificaton']);



Route::get('/Invitation-Acccepted/{token}', [GroupInvitationController::class, 'acceptInvitation']);

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);


 Route::middleware(['auth:api'])->group(function () {
    Route::post('/groups', [GroupController::class, 'create']);
    Route::post('/tasks', [TaskController::class, 'create']);
Route::get('/groups/{group_id}/{email}', [GroupInvitationController::class, 'invite']);


});


