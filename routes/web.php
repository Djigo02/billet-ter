<?php

use App\Http\Controllers\QrCodeController;
use Illuminate\Support\Facades\Route;
use App\Models\Gare;

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

Route::get('/', function () {
    return view('welcome', ['gares'=>Gare::all(), 'garesdest'=>Gare::all()->sortByDesc('id')]);
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/recu-billet', [QrCodeController::class, 'generate'])->name('recu-billet');


// Route::get('/qrcode',[GareController::class, 'generate']);
