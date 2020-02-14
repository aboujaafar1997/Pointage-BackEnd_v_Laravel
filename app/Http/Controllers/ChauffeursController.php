<?php

namespace App\Http\Controllers;

use App\User;
use App\Chauffeur;
use Illuminate\Http\Request;
use Response;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Requests;
class ChauffeursController extends Controller
{
  protected $validationRules = [
    'image' => 'mimes:jpg,png,jpeg'
];

    
    public function ajouterChauffeur(Request $request){
      try {   
      $path="";
      $validator = Validator::make($request->all(), $this->validationRules);
      if($validator->passes()){
        //  $path = $request->file('image')->store('image/'.$request->input("cin"));
        //  dd($path);
        $path=$request->file('image')->storeAs('public/images', $request->input("cin").'.png');
      }else{
        throw new Exception('Format non jpg png jpeg !!'); 
        // dd($validator->messages());
      } 
        $Chauffeur=new Chauffeur();
        $Chauffeur->cin=$request->input("cin");
        $data = $request->getContent();       
         $Chauffeur->n_permis_conduit=$request->input("n_permis_conduit");
         $Chauffeur->nom=$request->input("nom");
         $Chauffeur->prenom=$request->input("prenom");
         $Chauffeur->date_naissance=$request->input("date_naissance");
         $Chauffeur->adresse=$request->input("adresse");    
         $Chauffeur->image="images/".$request->input("cin").".png";
         $Chauffeur->save();
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

    public function listChauffeur(Request $request){
        try {       
       $Chauffeur=Chauffeur::all();
         return response()->json($Chauffeur);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
         catch(\Illuminate\Database\QueryException $ex){ 
        return response()->json(['message' => $e->getMessage()]); 
      }
    }

public function listChauffeurById($id){
  
    try {       
        $Chauffeur=new Chauffeur();
        $Chauffeur=DB::table('Chauffeurs')->where('nom', $id)->first();
        $Chauffeur=Chauffeur::find($Chauffeur->id); 
        return response()->json(["id"=>$Chauffeur->id,"nom"=>$Chauffeur->nom,"privslist"=>$Chauffeur->privs]);
         } catch (Exception $e) {
             return response()->json(['message' => $e->getMessage()]);
         }
          catch(\Illuminate\Database\QueryException $ex){ 
         return response()->json(['message' => $e->getMessage()]); 
       }
  
  
   
}


public function deleteChauffeurById($id){
    try {       
        $Chauffeur=Chauffeur::find($id);
        $Chauffeur->delete();
        error_log("delete Chauffeur : ".$Chauffeur->nom);
          return response()->json(['message' => 'OK']);
         } catch (Exception $e) {
             return response()->json(['message' => $e->getMessage()]);
         }
          catch(\Illuminate\Database\QueryException $ex){ 
         return response()->json(['message' => $e->getMessage()]); 
       }
}


public function getChauffeurByName($id){
    try {       
        $Chauffeur=Chauffeur::find($id);
          return response()->json($Chauffeur);
         } catch (Exception $e) {
             return response()->json(['message' => $e->getMessage()]);
         }
          catch(\Illuminate\Database\QueryException $ex){ 
         return response()->json(['message' => $e->getMessage()]); 
       }

}
}
