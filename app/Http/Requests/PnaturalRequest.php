<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PnaturalRequest extends FormRequest {

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
            'primer_nombre' => 'max:50|required',
            'primer_apellido' => 'max:50|required',
            'sexo' => 'required|max:1',
            'persona_id' => 'required'
        ];
    }

}
