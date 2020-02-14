<?php

namespace App\Http\Controllers;
use App\User;
use App\Pointage;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Collection;
class StatistiqueController extends Controller
{
    function statistique(Request $request){
        try{   
        $date =date('Y-m-d');
        $data=DB::select( "SELECT s.id_utilisateur,count(p.id_session) as number from pointages p , sessions s WHERE p.id_session=s.id and p.date like '".$date."%' GROUP BY s.id_utilisateur" );
        return response()->json($data);
       } catch (Exception $e) {
        return response()->json(['message' => "opps il'ya ereur de serveur"]);
    }
     catch(\Illuminate\Database\QueryException $ex){ 
    return response()->json(['message' => $e->getMessage()]); 
  }
    }
}
