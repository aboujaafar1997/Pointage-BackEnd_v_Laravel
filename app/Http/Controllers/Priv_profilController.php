<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Priv_profil;
use Response;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Requests;

class Priv_profilController extends Controller
{
    public function ajouterPriv_profil($id1,$id2){
        try {   
           $Priv_profil=new Priv_profil();  
           $Priv_profil->profil_id=$id1;
           $Priv_profil->priv_id=$id2;
           $Priv_profil->save();
           return Response::json(array(
            'message'   =>  "ok"
        ), 200);
          } catch (Exception $e) {
              return Response::json(array(
                'message'   =>  $e->getMessage()
            ), 501);
          }
           catch(\Illuminate\Database\QueryException $ex){ 
          return Response::json(array(
            'message'   =>  'les entrer avec ereur'
        ), 500);
        }
      }  
  public function deletePriv_profilById($id1,$id2){
      try {       
          DB::table('priv_profil')->where(['priv_id'=> $id2,'profil_id'=>$id1])->delete();
            return response()->json(['message' => 'OK']);
           } catch (Exception $e) {
               return response()->json(['message' => $e->getMessage()]);
           }
            catch(\Illuminate\Database\QueryException $ex){ 
           return response()->json(['message' => $e->getMessage()]); 
         }
  }
  
  
 
}
