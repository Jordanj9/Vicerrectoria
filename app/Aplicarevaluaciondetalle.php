<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aplicarevaluaciondetalle extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'valor', 'aplicarevaluacion_id', 'evaluacionindicador_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];

    public function aplicarevaluacion() {
        return $this->belongsTo('App\Aplicarevaluacion');
    }

    public function evaluacionindicador() {
        return $this->belongsTo('App\Evaluacionindicador');
    }

}
