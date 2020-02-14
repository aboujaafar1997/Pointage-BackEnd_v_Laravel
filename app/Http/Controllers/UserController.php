<?php

namespace App\Http\Controllers;
use App\User;
use App\Profil;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
 
    protected function ajouterUser(Request $request)
    {
        try{
          // $Profil=new Profil();
          // $Profil=DB::table('profils')->where('nom',$request->input("id_profil"))->first();
        User::create([
            'email' => $request->input("email"),
            'password' => Hash::make($request->input("password")),
            'id_profil'=>$request->input("id_profil")
        ]);
        return response()->json(['message' => "ok"]);

    } catch (Exception $e) {
        return response()->json(['message' => $e->getMessage()]);
    }
     catch(\Illuminate\Database\QueryException $ex){ 
    return response()->json(['message' => $e->getMessage()]); 
  }

}

public function listUser(Request $request){
    try {      
$response=[];
 $User=new User();      
 $User=User::all();
 foreach ($User as &$User0) {
   $authority=Profil::find($User0->id_profil);
    $User2=new User();      
    $User2->id=$User0->id;
    $User2->email=$User0->email;
    $User2->password=$User0->password;
    $User2->id_profil=$User0->id_profil;
    $User2->authorities=[['authority'=>'Role_'.$authority->nom]];
  array_push($response, $User2);
  
}

return response()->json($response);
    //  return response()->json([$User,'authorities'=>['authority'=>'Role_'.$authority->nom]]);
    } catch (Exception $e) {
        return response()->json(['message' => $e->getMessage()]);
    }
     catch(\Illuminate\Database\QueryException $ex){ 
    return response()->json(['message' => $e->getMessage()]); 
  }
}

public function listUserById($id){

try {       
    $User=new User();
    $User=DB::table('Users')->where('email', $id)->first();
    $User=User::find($User->id); 
    return response()->json(["id"=>$User->id,"nom"=>$User->nom,"privslist"=>$User->privs]);
     } catch (Exception $e) {
         return response()->json(['message' => $e->getMessage()]);
     }
      catch(\Illuminate\Database\QueryException $ex){ 
     return response()->json(['message' => $e->getMessage()]); 
   }



}


public function deleteUserById($id){
try {       
    $User=User::find($id);
    $User->delete();
    error_log("delete User : ".$User->nom);
      return response()->json(['message' => 'OK']);
     } catch (Exception $e) {
         return response()->json(['message' => $e->getMessage()]);
     }
      catch(\Illuminate\Database\QueryException $ex){ 
     return response()->json(['message' => $e->getMessage()]); 
   }
}
   public function getUserByName($id){
    try {       
        $User=User::find($id);
          return response()->json($User);
         } catch (Exception $e) {
             return response()->json(['message' => $e->getMessage()]);
         }
          catch(\Illuminate\Database\QueryException $ex){ 
         return response()->json(['message' => $e->getMessage()]); 
       }
}
}


