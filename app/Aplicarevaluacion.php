<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aplicarevaluacion extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'unidadacademica', 'materia_codigomateria', 'docente_pegea', 'docente_pegeq', 'personanaturala', 'personanaturalq', 'programa_id', 'periodoacademico_id', 'evaluacionaah_id', 'unidad_id', 'estudiantepensum_id', 'jefedepartamento_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];
    
    public function aplicarevaluaciondetalles() {
        return $this->hasMany('App\Aplicarevaluaciondetalle');
    }

    public function programa() {
        return $this->belongsTo('App\Programa');
    }

    public function evaluacionaah() {
        return $this->belongsTo('App\Evaluacionaah');
    }

    public function periodoacademico() {
        return $this->belongsTo('App\Periodoacademico');
    }

    public function unidad() {
        return $this->belongsTo('App\Unidad');
    }

    public function estudiantepensum() {
        return $this->belongsTo('App\Estudiantepensum');
    }

    public function jefedepartamento() {
        return $this->belongsTo('App\Jefedepartamento');
    }

}
