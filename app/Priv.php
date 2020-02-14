<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Priv;
use App\Profil;
use App\Priv_profil;
class Priv extends Model
{
    public $table="privs";
    public $timestamps=false;

    public function profils(){
        return $this->belongsToMany('App\Profil');
    }
    
}
