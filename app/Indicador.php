<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicador extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'indicador', 'criterioevaluacion_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];

    public function criterioevaluacion() {
        return $this->belongsTo('App\Criterioevaluacion');
    }
    
    public function evaluacionindicadors() {
        return $this->hasMany('App\Evaluacionindicador');
    }

}
