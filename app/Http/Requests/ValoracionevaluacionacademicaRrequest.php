<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValoracionevaluacionacademicaRrequest extends FormRequest {

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
            'acronimo' => 'required|min:2',
            'valor_cualitativo' => 'required',
            'valor_cuat1' => 'required',
            'valor_cuat2' => 'required'
        ];
    }

}
