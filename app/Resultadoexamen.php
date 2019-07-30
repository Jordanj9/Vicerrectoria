<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resultadoexamen extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'intentos', 'fecharealizacion', 'estado', 'calificacion', 'puntostotal', 'puntosalcanzados', 'estudiante_id', 'examen_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];

    public function estudiante() {
        return $this->belongsTo('App\Estudiante');
    }

    public function examen() {
        return $this->belongsTo('App\Examen');
    }

    public function resultadoexamenrespuestas() {
        return $this->hasMany('App\Resultadoexamenrespuesta');
    }

}
