<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Profil;
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    public $timestamps=false;
    
    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
  
    public function getJWTCustomClaims()
    {
        $r=Profil::find($this->id_profil);
      //  error_log($r->nom."hey");
        $arry=["authority"=>$r->nom];
        return [
            'sub'           => $this->id,
            'id_profil'       => [$arry],
        ];
    }

    protected $fillable = [
        'id', 'email','password','id_profil','authorities'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];
}