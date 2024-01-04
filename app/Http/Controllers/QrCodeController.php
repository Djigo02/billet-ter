<?php

namespace App\Http\Controllers;

use App\Models\Gare;
use Illuminate\Http\Request;
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
        $emission = date('d-m-Y');
        $fin = date('d-m-Y', strtotime(date('d-M-Y'). ' + 5 days'));

        //chemin pour enregistrer le qrcode
        $chemin = "assets/qrcode/FA_".date('dmyHis').".svg";
        //qrcode à afficher
        $qrcode = QrCode::size(150)->generate("
            Zone concernée : $garedepart->zone_id -> $garedestination->zone_id \n
            Depart : $request->depart \n
            Destination : $request->destination \n
            Prix : $request->prix \n
            Date emission : $emission \n
            Fin de validite : $fin \n
        ", $chemin);


        //info a afficher sur la page
        $info = [
            'image' => $chemin,
            'zone' => "Zone $garedepart->zone_id -> $garedestination->zone_id",
            'depart'=> "Depart : $garedepart->nom",
            'destination'=> "Destination : $garedestination->nom",
            'prix'=>"Prix : $request->prix",
            'date'=> "Date emission : ".$emission,
            'fin'=> "Fin de validite : $fin"
        ];
        return view("qrcode", ['qrcode'=>$qrcode, 'info'=>$info]);
    }
}
