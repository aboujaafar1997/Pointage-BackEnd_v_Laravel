<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Priv;
use App\Profil;
use App\Priv_profil;
use Illuminate\Http\Request;

class test extends Controller
{
    public function hre(Request $request){
        $privs1= new Priv();
        $privs2=new Priv();
        $profil=new profil();
    
        $privs1->nom_privs="gestion";
        $privs1->description="gestion";
        $privs1->categorie="/gestion";
        $privs1->composant="/gestion";
        $privs1->save();
    
        $privs2->nom_privs="gestion2";
        $privs2->description="gestion2";
        $privs2->categorie="/gestion2";
        $privs2->composant="/gestion2";
        $privs2->save();
    
        $profil=Profil::find(1);
        error_log($profil);
    
        $privs_profil=new Priv_profil();
        $privs_profil->profil_id=$profil->id;
        $privs_profil->priv_id=$privs1->id;
        $privs_profil->save();


        $privs_profil1=new Priv_profil();
        $privs_profil1->profil_id=$profil->id;
        $privs_profil1->priv_id=$privs2->id;
        $privs_profil1->save();
    

      // $am= request(['event']);
      $i=1;
         return response()->json([
            'profil'=>$profil->privs
        ]);
    }
}
