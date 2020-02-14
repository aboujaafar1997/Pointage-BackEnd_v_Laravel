<?php

namespace App\Http\Controllers;

use App\User;
use App\Taxi;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Excel;
use Exporter;
use Importer;
use App\Chauffeur;
use Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Requests;
class TaxiController extends Controller
{
    public function ajouterTaxi(Request $request){
        try {       
        $Taxi=new Taxi();
         $Taxi->matricule	=$request->input("matricule");
         $Taxi->modele=$request->input("modele");
         $Taxi->save();
         return response()->json(['message' => 'OK']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
         catch(\Illuminate\Database\QueryException $ex){ 
        return response()->json(['message' => $e->getMessage()]); 
      }
    }


    public function listTaxi(Request $request){
        try {       
       $Taxi=Taxi::all();
         return response()->json($Taxi);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
         catch(\Illuminate\Database\QueryException $ex){ 
        return response()->json(['message' => $e->getMessage()]); 
      }
    }

public function listTaxiById($id){
  
    try {       
        $Taxi=new Taxi();
        $Taxi=DB::table('Taxis')->where('nom', $id)->first();
        $Taxi=Taxi::find($Taxi->id); 
        return response()->json(["id"=>$Taxi->id,"nom"=>$Taxi->nom,"privslist"=>$Taxi->privs]);
         } catch (Exception $e) {
             return response()->json(['message' => $e->getMessage()]);
         }
          catch(\Illuminate\Database\QueryException $ex){ 
         return response()->json(['message' => $e->getMessage()]); 
       }
  
  
   
}


public function deleteTaxiById($id){
    try {       
        $Taxi=Taxi::find($id);
        $Taxi->delete();
        error_log("delete Taxi : ".$Taxi->nom);
          return response()->json(['message' => 'OK']);
         } catch (Exception $e) {
             return response()->json(['message' => $e->getMessage()]);
         }
          catch(\Illuminate\Database\QueryException $ex){ 
         return response()->json(['message' => $e->getMessage()]); 
       }
}


public function getTaxiByName($id){
    try {       
        $Taxi=Taxi::find($id);
          return response()->json($Taxi);
         } catch (Exception $e) {
             return response()->json(['message' => $e->getMessage()]);
         }
          catch(\Illuminate\Database\QueryException $ex){ 
         return response()->json(['message' => $e->getMessage()]); 
       }
}

protected $validationRules = [
  'file' =>'max:5000|mimes:xlsx,csv'
];
function import(Request $request)
    {
      try { 
        $validator = Validator::make($request->all(), $this->validationRules);
        if($validator->passes()){
          $savePath=public_path("/upload/");
         // $path=$request->file('file')->storeAs($savepath,date('Y-m-d').'.xlsx');
          $file=$request->file('file');
          $fileName=" ".date('Y-m-d');
          $file->move($savePath,$fileName);
          $excel = Importer::make('Excel');
          $excel->load($savePath.$fileName);  
          $collection = $excel->getCollection();  
          for($row=1;$row<sizeof($collection);$row++){
           $Taxi=new Taxi();
           $Taxi->modele=$collection[$row][2];
           $Taxi->matricule=$collection[$row][1];
           $Taxi->save();
          }
             return Response::json(array(
              'message'   =>  'ok'
          ), 200);
        }else{
          throw new Exception('Format non xsls !!'); 
}
    } catch (Exception $e) {
      return Response::json(array(
          'message'   =>  $e->getMessage()
      ), 500);
    }
     catch(\Illuminate\Database\QueryException $ex){ 
    return response()->json(['message' => $e->getMessage()]); 
  }
    }

}
