<?php

namespace App\Http\Controllers;

use App\Models\Gare;
use App\Models\Reservation;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    
    public function generate(Request $request){

        //valider le formulaire
        $request->validate(
            [
                'depart'=>'required',
                'destination'=>'required',
                'prix'=>'required',
            ]
        );

        //info Gare de depart dans la base
        $garedepart = Gare::all()->find($request->depart);

        //info Gare de destination dans la base
        $garedestination = Gare::all()->find($request->destination);

        //Date emission et fin de validite
        $emission = date('d-m-Y H:i:s');
        $fin = date('d-m-Y', strtotime(date('d-M-Y H:i:s'). ' + 5 days'));

        //chemin pour enregistrer le qrcode
        $chemin = "assets/qrcode/FA_".date('dmyHis').".svg";
        


        //info a afficher sur la page
        $info = [
            'image' => $chemin,
            'zone' => "Zone $garedepart->zone_id -> $garedestination->zone_id",
            'depart'=> "Depart : $garedepart->nom",
            'destination'=> "Destination : $garedestination->nom",
            'prix'=>"Prix : $request->prix Francs CFA",
            'date'=> "Date emission : ".$emission,
            'fin'=> "Fin de validite : $fin"
        ];
        
        //qrcode à afficher enregistrer dans un repertoire du projet
        QrCode::size(150)->generate("
            Zone concernée : $garedepart->zone_id -> $garedestination->zone_id \n
            Depart : $garedepart->nom \n
            Destination : $garedestination->nom \n
            Prix : $request->prix \n
            Date emission : $emission \n
            Fin de validite : $fin \n
        ", $chemin);

        // Insertion des données dans la table reservations
        $reservation = new Reservation();
        $reservation->image = $chemin;
        $reservation->zone = "Zone $garedepart->zone_id -> $garedestination->zone_id";
        $reservation->depart = "Depart : $garedepart->nom";
        $reservation->destination = "Destination : $garedestination->nom";
        $reservation->prix = $request->prix;
        $reservation->date_emission = "Date emission : ".$emission;
        $reservation->fin_validite = "Fin de validite : $fin";
        $reservation->id_user = Session::get('utilisateur')['id'];
        // dd($reservation);
        $reservation->save();
        return view("reservations.qrcode", ['info'=>$info]);
    }

    public function detailRecu($id){
        $detail = Reservation::all()->find($id);
        $info = [
            'image' => $detail->image,
            'zone' => $detail->zone,
            'depart'=> $detail->depart,
            'destination'=> $detail->destination,
            'prix'=> $detail->prix." Francs CFA",
            'date'=> $detail->date_emission,
            'fin'=> $detail->fin_validite
        ];
        // new DateTime(explode(" ",$detail->date_emission)[3])
        // dd($diff);
        // return Pdf::loadView("reservations.detail", compact("info"))->stream();
        return view("reservations.qrcode", ['info'=>$info]);
    }
}
