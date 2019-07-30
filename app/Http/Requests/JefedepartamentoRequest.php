<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JefedepartamentoRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'fechainicio' => 'required',
            'fechafin' => 'required',
            'personanatural_id' => 'required',
            'departamento_id' => 'required'
        ];
    }

}
