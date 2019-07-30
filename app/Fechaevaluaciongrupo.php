<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fechaevaluaciongrupo extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'fechainicio', 'fechafin', 'grupo_id', 'periodoacademico_id', 'evaluacionacademico_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];

    public function grupo() {
        return $this->belongsTo('App\Grupo');
    }

    public function Periodoacademico() {
        return $this->belongsTo('App\Periodoacademico');
    }

    public function Evaluacionacademico() {
        return $this->belongsTo('App\Evaluacionacademico');
    }

}
