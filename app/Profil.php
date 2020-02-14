<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Priv;
use App\Profil;
use App\Priv_profil;
class Profil extends Model
{
    public $table="profils";
    public $timestamps=false;
    
    public function privs(){
        return $this->belongsToMany('App\Priv');
    }
}
