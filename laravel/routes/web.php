<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Place;
// Mis importaciones
use App\Http\Controllers\MailController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\LanguageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function (Request $request) {
    $message = 'Loading welcome page';
    Log::info($message);
    $request->session()->flash('info', $message);
    return view('welcome');
 });
 

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('mail/test', [MailController::class, 'test']);
// or
// Route::get('mail/test', 'App\Http\Controllers\MailController@test');

Route::resource('files', FileController::class)->middleware(['auth', 'cualquier_rol:1,3']);

Route::resource('places', PlaceController::class)->middleware(['auth', 'verified']);


Route::post('/places/{place}/favourite', [PlaceController::class, 'favourite'])
    ->name('places.favourite')->middleware('can:favourite,place');

Route::delete('/places/{place}/unfavourite', [PlaceController::class, 'unfavourite'])
    ->name('places.unfavourite')->middleware('can:unfavourite,place');

// Ruta para cambiar el idioma
Route::get('/language/{locale}', [LanguageController::class, 'language'])->name('language');


require __DIR__.'/auth.php';
