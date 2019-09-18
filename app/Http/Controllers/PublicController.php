<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddPatientRequest;
use App\Models\Patient;
use App\Models\Fiche;
use Validator;
use Flashy;

class PublicController extends Controller
{
	public function index(){
		return view('welcome');

	}
	public function addPatient(AddPatientRequest $request){
        $count_patients = Patient::where('statut','en_attente')->count();
    	$fiche =Fiche::where('num_fiche',request()->num_fiche)->first();

        Patient::updateOrCreate([
			'idfiches'=>$fiche->idfiches,
			'idservices'=>request()->idservices
        ]);
        Flashy::message("Vous êtes inscrit dans la fille d\'attente!!! $count_patients patien(s) en attente");
		return view('welcome');
	}
    public function affiche(){
    	$patients = Patient::JoinFiche()
    						->JoinService()
    						->where('statut','en_cours')
    						->orWhere('statut','en_attente')
    						->orderBy('patients.statut','DESC')
    						->orderBy('patients.updated_at','ASC')
    						->get();
        if (request()->ajax()) {
           return view('_affiche_patients_public',compact('patients'));
        }
    	return view('affiche',compact('patients'));
    }
}
