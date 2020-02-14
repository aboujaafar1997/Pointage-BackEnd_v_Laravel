<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Priv;
use Response;
use Illuminate\Support\Facades\DB;
class PrivController extends Controller
{
   
    public function ajouterpriv(Request $request){
        try {       
        $priv=new Priv();
         $priv->nom_privs=$request->input("nom_privs");
         $priv->description=$request->input("description");
         $priv->categorie=$request->input("categorie");
         $priv->composant=$request->input("composant");
         $priv->save();
         return Response::json(array(
          'message'   =>  "Bien ajouter !"
      ), 200);
        } 
        catch(\Illuminate\Database\QueryException $ex){ 
          return Response::json(array(
            'message'   =>  'x0001x il ya un ereur des entres Svp verffier !!'
        ), 500);
      }
        catch (Exception $e) {
            return Response::json(array(
              'message'   =>  'x0001x il ya un ereur des entres Svp verffier !!'
          ), 501);
        }
        
  }


    public function listpriv(Request $request){
        try {       
       $priv=Priv::all();
         return response()->json($priv);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
         catch(\Illuminate\Database\QueryException $ex){ 
        return response()->json(['message' => $e->getMessage()]); 
      }
    }

public function listprivById($id){
    try {       
        // $privs2->nom_privs="555";
        // $privs2->description="gestion2";
        // $privs2->categorie="/gestion2";
        // $privs2->composant="/gestion2";
        // $privs2->save();
        $priv=Priv::find($id);
          return response()->json($priv);
         } catch (Exception $e) {
             return response()->json(['message' => $e->getMessage()]);
         }
          catch(\Illuminate\Database\QueryException $ex){ 
         return response()->json(['message' => $e->getMessage()]); 
       }
}


public function deleteprivById($id){
    try {       
        $priv=Priv::find($id);
        $priv->delete();
          return response()->json(['message' => 'OK']);
         } catch (Exception $e) {
             return response()->json(['message' => $e->getMessage()]);
         }
          catch(\Illuminate\Database\QueryException $ex){ 
         return response()->json(['message' => $e->getMessage()]); 
       }
}


public function getprivByName($id){
    try {       
        $priv=DB::table('privs')->where('nom_privs', $id)->first();
          return response()->json($priv);
         } catch (Exception $e) {
             return response()->json(['message' => $e->getMessage()]);
         }
          catch(\Illuminate\Database\QueryException $ex){ 
         return response()->json(['message' => $e->getMessage()]); 
       }
}



}
