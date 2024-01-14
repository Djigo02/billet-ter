<?php

use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UtilisateurController;
use Illuminate\Support\Facades\Route;
use App\Models\Gare;
use App\Models\Reservation;
use App\Models\Utilisateur;

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
Route::get('/admin', function(){
    $users = Utilisateur::all();
    $users = count($users);
    $reservations = Reservation::all();
    $ca = 0;
    foreach ($reservations as $value) {
        $ca =$ca + $value->prix;
    }
    return view("admin.index",['ca'=>$ca, 'utilisateurs'=>$users]);
});

Route::get('/', function () {
    //return view('reservations.welcome', ['gares'=>Gare::all(), 'garesdest'=>Gare::all()->sortByDesc('id')]);
    return redirect('/login');
})->name('login');


// Page vers la reservation
Route::get('/reserver', function(){
    return view('reservations.reserver', ['gares'=>Gare::all(), 'garesdest'=>Gare::all()->sortByDesc('id')]);
})->name('reserver');

Route::get('/reservations/{id}', [ReservationController::class, 'reservations'])->name('mes_reservations');

Route::post('/recu-billet', [QrCodeController::class, 'generate'])->name('recu-billet');

Route::get('/billet/{id}', [QrCodeController::class, 'detailRecu'])->name('detailRecu');

// Authentification et enregistrement

Route::get('/login', [UtilisateurController::class, 'login'])->name('utilisateurs.login');
Route::post('/auth', [UtilisateurController::class, 'doLogin'])->name('utilisateurs.doLogin');

Route::get('/signup', [UtilisateurController::class, 'signup'])->name('utilisateurs.signup');
Route::post('/register', [UtilisateurController::class, 'doSignup'])->name('utilisateurs.register');
Route::get('/deconnexion', [UtilisateurController::class, 'deconnexion'])->name('deconnexion');

