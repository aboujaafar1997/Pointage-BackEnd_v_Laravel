<?php

namespace App\Http\Controllers;

use App\User;
use App\Pointage;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Collection;
class PointageController extends Controller
{
    public function ajouterPointage(Request $request){
        try {       
          $data=(array)$request->all();
          for ($i=0;$i<sizeof($data);$i++) {
           $Pointage0=new Pointage();
           $arr=$request[$i];        
           $Pointage0->id_taxi=$arr["id_taxi"];
           $Pointage0->id_permis=$arr["id_permis"];
           $Pointage0->id_session=$arr["id_session"];
           $Pointage0->date=$arr["date"];
           $Pointage0->save();
           error_log("pointage passe avec id :".$Pointage0->id);
        }
        
         return response()->json(["message"=>"ok"]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
         catch(\Illuminate\Database\QueryException $ex){ 
        return response()->json(['message' => $e->getMessage()]); 
      }
    }


    public function listPointage(Request $request){
        try {       
       $Pointage=Pointage::orderBy('id', 'DESC')->get();
         return response()->json($Pointage);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
         catch(\Illuminate\Database\QueryException $ex){ 
        return response()->json(['message' => $e->getMessage()]); 
      }
    }

public function listPointageById($id){
  
    try {       
        $Pointage=new Pointage();
        $Pointage=DB::table('Pointages')->where('nom', $id)->first();
        $Pointage=Pointage::find($Pointage->id); 
        return response()->json(["id"=>$Pointage->id,"nom"=>$Pointage->nom,"privslist"=>$Pointage->privs]);
         } catch (Exception $e) {
             return response()->json(['message' => $e->getMessage()]);
         }
          catch(\Illuminate\Database\QueryException $ex){ 
         return response()->json(['message' => $e->getMessage()]); 
       }
  
  
   
}


public function deletePointageById($id){
    try {       
        $Pointage=Pointage::find($id);
        $Pointage->delete();
        error_log("delete Pointage : ".$Pointage->nom);
          return response()->json(['message' => 'OK']);
         } catch (Exception $e) {
             return response()->json(['message' => $e->getMessage()]);
         }
          catch(\Illuminate\Database\QueryException $ex){ 
         return response()->json(['message' => $e->getMessage()]); 
       }
}


public function getPointageByName($id){
    try {       
        $Pointage=Pointage::find($id);
          return response()->json($Pointage);
         } catch (Exception $e) {
             return response()->json(['message' => $e->getMessage()]);
         }
          catch(\Illuminate\Database\QueryException $ex){ 
         return response()->json(['message' => $e->getMessage()]); 
       }
}
}
