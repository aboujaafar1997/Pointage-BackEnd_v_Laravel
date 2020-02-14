<?php

namespace App\Http\Controllers;

use App\User;
use App\Permis;
use PDF;
use App\Chauffeur;
use Illuminate\Http\Request;
use Exception;
use Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PermisController extends Controller
{
    public function ajouterpermis(Request $request){
        try {       
        $permis=new permis();
         $permis->date_del=date('Y-m-d');
         $permis->date_exp= date('Y-m-d', strtotime('+5 years'));;
         $permis->n_tage=$request->input("n_tage");
         $permis->is_valide=$request->input("is_valide");
         $permis->id_chauffeur=$request->input("id_chauffeur");
         $permis->save();
         return response()->json(['message' => 'OK']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
         catch(\Illuminate\Database\QueryException $ex){ 
        return response()->json(['message' => $e->getMessage()]); 
      }
    }


    public function listpermis(Request $request){
        try {       
       $permis=permis::all();
         return response()->json($permis);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
         catch(\Illuminate\Database\QueryException $ex){ 
        return response()->json(['message' => $e->getMessage()]); 
      }
    }

public function listpermisById($id){
  
    try {       
        $permis=new permis();
        $permis=DB::table('permiss')->where('nom', $id)->first();
        $permis=permis::find($permis->id); 
        return response()->json(["id"=>$permis->id,"nom"=>$permis->nom,"privslist"=>$permis->privs]);
         } catch (Exception $e) {
             return response()->json(['message' => $e->getMessage()]);
         }
          catch(\Illuminate\Database\QueryException $ex){ 
         return response()->json(['message' => $e->getMessage()]); 
       }
  
  
   
}


public function deletepermisById($id){
    try {       
        $permis=permis::find($id);
        $permis->delete();
        error_log("delete permis : ".$permis->nom);
          return response()->json(['message' => 'OK']);
         } catch (Exception $e) {
             return response()->json(['message' => $e->getMessage()]);
         }
          catch(\Illuminate\Database\QueryException $ex){ 
         return response()->json(['message' => $e->getMessage()]); 
       }
}


public function getpermisByName($id){
    try {       
        $permis=permis::find($id);
          return response()->json($permis);
         } catch (Exception $e) {
             return response()->json(['message' => $e->getMessage()]);
         }
          catch(\Illuminate\Database\QueryException $ex){ 
         return response()->json(['message' => $e->getMessage()]); 
       }
}

function getChauffeurFromPermis($id){
try{
  $permis=Permis::find($id);
if($permis->is_valide=="false"){
      throw new Exception("permis expiré !");
}
 $idchauffeur=$permis->id_chauffeur;
 $Chauffeur=Chauffeur::find($idchauffeur);

 return Response::json($Chauffeur, 200);
} catch (Exception $e) {
    return Response::json(array(
      'message'   =>  $e->getMessage()
  ), 500);
}
 catch(\Illuminate\Database\QueryException $ex){ 
return Response::json(array(
  'message'   =>  'les entrer avec ereur'
), 500);
}

}


public function export ($id,$permis){
try{
$data1=Chauffeur::find($id);
$data2=$permis;
$data=['data1'=>$data1];

//$data=["bitch"=>"bitch"];

$pdf=PDF::loadView('Permis',compact('data'));
//$pdf->isHtml5ParserEnabled=true;
return $pdf->stream($data1->cin.'.pdf');
} catch (Exception $e) {
  return Response::json(array(
    'message'   =>  $e->getMessage()
), 500);
}

}

}
