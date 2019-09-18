<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Service;
use Flashy;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id_user_service = auth()->user()->idservices;
        $service = Service::find($id_user_service);
        $patients = Patient::JoinFiche()
                            ->where('idservices',$id_user_service)
                            ->where('statut','en_attente')
                            ->orWhere('statut','en_cours')
                            ->orderBy('patients.statut','DESC')
                            ->orderBy('patients.updated_at','ASC')
                            ->get();

        if (request()->ajax()) {
           return view('_affiche_patients',compact('patients','service'));
        }
        return view('home',compact('patients','service'));
    }

    public function traiterPatient(Patient $patient){
        $patient->statut ="terminer";
        $patient->save();
        Flashy::message("Opération effectuée avec succès");
        return redirect()->route('home');
    }

    public function appelerPatient(Patient $patient){
        $patient->statut ="en_cours";
        $patient->save();
        Flashy::message("Opération effectuée avec succès");
        return redirect()->route('home');
    }
    public function passerPatient(Patient $patient){
        $patient->statut ="en_attente";
        $patient->save();
        Flashy::message("Opération effectuée avec succès");
        return redirect()->route('home');
    }
}
