<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use App\Profil;
use App\Priv_profil;
use Illuminate\Support\Facades\DB;
class ProfilController extends Controller
{
    public function ajouterProfil(Request $request){
        try {       
        $profil=new Profil();
         $profil->nom=$request->input("nom");
         $list=$request->input("privslist");
         $profil->save();
          for($i=0;$i<sizeof($list);$i++){
            $Priv_profil=new Priv_profil();
            $Priv_profil->profil_id=$profil->id;
            $Priv_profil->priv_id=$list[$i];
            $Priv_profil->save();
          }
         return response()->json(['message' => 'OK']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
         catch(\Illuminate\Database\QueryException $ex){ 
        return response()->json(['message' => $e->getMessage()]); 
      }
    }


    public function listProfil(Request $request){
        try {       
       $profil=Profil::all();
         return response()->json($profil);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
         catch(\Illuminate\Database\QueryException $ex){ 
        return response()->json(['message' => $e->getMessage()]); 
      }
    }

public function listProfilById($id){
  
    try {       
        $profil=new Profil();
        $profil=DB::table('profils')->where('nom', $id)->first();
        $profil=Profil::find($profil->id); 
        return response()->json(["id"=>$profil->id,"nom"=>$profil->nom,"privslist"=>$profil->privs]);
         } catch (Exception $e) {
             return response()->json(['message' => $e->getMessage()]);
         }
          catch(\Illuminate\Database\QueryException $ex){ 
         return response()->json(['message' => $e->getMessage()]); 
       }
  
  
   
}


public function deleteProfilById($id){
    try {       
        $profil=Profil::find($id);
        $profil->delete();
        error_log("delete profil : ".$profil->nom);
          return response()->json(['message' => 'OK']);
         } catch (Exception $e) {
             return response()->json(['message' => $e->getMessage()]);
         }
          catch(\Illuminate\Database\QueryException $ex){ 
         return response()->json(['message' => $e->getMessage()]); 
       }
}


public function getProfilByName($id){
    try {       
        $profil=Profil::find($id);
          return response()->json($profil->privs);
         } catch (Exception $e) {
             return response()->json(['message' => $e->getMessage()]);
         }
          catch(\Illuminate\Database\QueryException $ex){ 
         return response()->json(['message' => $e->getMessage()]); 
       }
}

}





