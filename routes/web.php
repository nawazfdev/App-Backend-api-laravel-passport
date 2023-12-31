<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\GroupInvitationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|---------------------------------------;-----------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('admin.admin_master');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// API Route
Route::get('/email-verified/{token} ', [RegisterController::class, 'emailverificaton']);
Route::get('/Invitation-Acccepted/{token}', [GroupInvitationController::class, 'acceptInvitation']);

// Web Register 
Route::get('/register', [AdminController::class, 'register']);
require __DIR__.'/auth.php';
?>
