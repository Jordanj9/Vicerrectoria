<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resultadoexamenrespuesta extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'respuesta', 'estado', 'ok', 'respuesta_id', 'pregunta_id', 'resultadoexamen_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];

    public function resultadoexamen() {
        return $this->belongsTo('App\Resultadoexamen');
    }

    public function pregunta() {
        return $this->belongsTo('App\Pregunta');
    }

    public function respuesta() {
        return $this->belongsTo('App\Respuesta');
    }

}
