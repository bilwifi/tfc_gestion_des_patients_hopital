<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fiche extends Model
{
    protected $primaryKey = 'idfiches';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom', 'postnom','prenom','pseudo'
    ];

    protected static function boot(){
        parent::boot();

        static::created(function($fiche){
           $fiche->num_fiche = 'HBMM'.date('Y').'-'.$fiche->idfiches;
        });
    }
}
