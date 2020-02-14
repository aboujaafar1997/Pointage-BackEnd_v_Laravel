<?php

namespace App\Http\Controllers;

use App\User;
use App\Session;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{


      public function ajouterSession(Request $request){
          try {       
           $Session=new Session();
           $Session->id_utilisateur=$request->input("id_utilisateur");
           $Session->date=$request->input("date");
           $Session->ip=$request->input("ip");
           $Session->save();
           return response()->json($Session->id);
          } catch (Exception $e) {
              return response()->json(['message' => $e->getMessage()]);
          }
           catch(\Illuminate\Database\QueryException $ex){ 
          return response()->json(['message' => $e->getMessage()]); 
        }
      }
  
  
      public function listSession(Request $request){
          try {       
         $Session=Session::orderBy('id', 'DESC')->get();
           return response()->json($Session);
          } catch (Exception $e) {
              return response()->json(['message' => $e->getMessage()]);
          }
           catch(\Illuminate\Database\QueryException $ex){ 
          return response()->json(['message' => $e->getMessage()]); 
        }
      }
  
  public function listSessionById($id){
    
      try {       
          $Session=new Session();
          $Session=DB::table('Sessions')->where('nom', $id)->first();
          $Session=Session::find($Session->id); 
          return response()->json(["id"=>$Session->id,"nom"=>$Session->nom,"privslist"=>$Session->privs]);
           } catch (Exception $e) {
               return response()->json(['message' => $e->getMessage()]);
           }
            catch(\Illuminate\Database\QueryException $ex){ 
           return response()->json(['message' => $e->getMessage()]); 
         }
    
    
     
  }
  
  
  public function deleteSessionById($id){
      try {       
          $Session=Session::find($id);
          $Session->delete();
          error_log("delete Session : ".$Session->nom);
            return response()->json(['message' => 'OK']);
           } catch (Exception $e) {
               return response()->json(['message' => $e->getMessage()]);
           }
            catch(\Illuminate\Database\QueryException $ex){ 
           return response()->json(['message' => $e->getMessage()]); 
         }
  }
  
  
  public function getSessionByName($id){
      try {       
          $Session=Session::find($id);
            return response()->json($Session);
           } catch (Exception $e) {
               return response()->json(['message' => $e->getMessage()]);
           }
            catch(\Illuminate\Database\QueryException $ex){ 
           return response()->json(['message' => $e->getMessage()]); 
         }
  }
  
  }
  
  
  
  
  
  

