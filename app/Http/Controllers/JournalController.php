<?php

namespace App\Http\Controllers;
use App\User;
use App\Journal;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class JournalController extends Controller
{
    public function ajouterJournal(Request $request){
        try {       
        $Journal=new Journal();
         $Journal->event=$request->input("event");
         $Journal->date=$request->input("date");
         $Journal->session=$request->input("session");
         $Journal->save();
         return response()->json(['message' => 'OK']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
         catch(\Illuminate\Database\QueryException $ex){ 
        return response()->json(['message' => $e->getMessage()]); 
      }
    }
    public function listJournal(Request $request){
        try {       
       $Journal=Journal::orderBy('id', 'DESC')->get();
         return response()->json($Journal);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
         catch(\Illuminate\Database\QueryException $ex){ 
        return response()->json(['message' => $e->getMessage()]); 
      }
    }

public function listJournalById($id){
  
    try {       
        $Journal=new Journal();
        $Journal=DB::table('Journals')->where('nom', $id)->first();
        $Journal=Journal::find($Journal->id); 
        return response()->json(["id"=>$Journal->id,"nom"=>$Journal->nom,"privslist"=>$Journal->privs]);
         } catch (Exception $e) {
             return response()->json(['message' => $e->getMessage()]);
         }
          catch(\Illuminate\Database\QueryException $ex){ 
         return response()->json(['message' => $e->getMessage()]); 
       }
}


public function deleteJournalById($id){
    try {       
        $Journal=Journal::find($id);
        $Journal->delete();
        error_log("delete Journal : ".$Journal->nom);
          return response()->json(['message' => 'OK']);
         } catch (Exception $e) {
             return response()->json(['message' => $e->getMessage()]);
         }
          catch(\Illuminate\Database\QueryException $ex){ 
         return response()->json(['message' => $e->getMessage()]); 
       }
}


public function getJournalByName($id){
    try {       
        $Journal=Journal::find($id);
          return response()->json($Journal);
         } catch (Exception $e) {
             return response()->json(['message' => $e->getMessage()]);
         }
          catch(\Illuminate\Database\QueryException $ex){ 
         return response()->json(['message' => $e->getMessage()]); 
       }
}

}
