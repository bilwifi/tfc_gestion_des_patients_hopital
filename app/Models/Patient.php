<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $primaryKey = 'idpatients';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idfiches', 'idservices','statut'
    ];

    public static function scopeJoinFiche($query){

        return $query->join('fiches','fiches.idfiches','=','patients.idfiches');               
    }
    public static function scopeJoinService($query){

        return $query->join('services','services.idservices','=','patients.idservices');               
    }
}
