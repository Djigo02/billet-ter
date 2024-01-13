<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ReservationController extends Controller
{
    // liste de reservation d'un utilisateur

    public function reservations($id){
        if($id==Session::get('utilisateur')['id']){
            $reservations = DB::table('reservations')->where('id_user','=',$id)->get();
            return view('reservations', compact('reservations'));
        }else{
            return redirect('/login');
        }

    }
}
