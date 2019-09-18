<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Fiche;
use App\Models\Patient;
use Flashy;
class AddPatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function withValidator($validator){
         $validator->after(function ($validator) {
            $fiche =Fiche::where('num_fiche',request()->num_fiche)->first();
            if ($fiche != null) {
                $patients =Patient::where('idfiches',$fiche->idfiches)
                                ->where('statut','en_attente')
                                ->orWhere('statut','en_cours')
                                ->first();
                if ($patients != null) {

                    if ($patients->idfiches == $fiche->idfiches ) {
                        Flashy::error('Vous êtes déjà enregistrer dans la fille d\'attente...');
                        
                        $validator->errors()->add('field', 'Vous êtes déjà enregistrer !');
                    }
            }else{
                Flashy::error('Numéro de fiche incorrect');
                        return redirect()->back();  
                        $validator->errors()->add('num_fiche', 'incorrect');
            }
        }
            
        });     
        if ($validator->fails()) {

            Flashy::error('une erreure est survenue');
            return redirect()->back();            
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'num_fiche' => 'required|string|exists:fiches,num_fiche',
            'idservices' => 'required|string|exists:services',
        ];
    }
}
