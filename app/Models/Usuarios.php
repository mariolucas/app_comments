<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Tymon\JWTAuth\Contracts\JWTSubject; 

class Usuarios extends Authenticatable implements JWTSubject
{
    protected $table = 'usuarios';
    protected $fillable = ['nome', 'email', 'senha'];
    protected $dates = ['created_at', 'updated_at'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
