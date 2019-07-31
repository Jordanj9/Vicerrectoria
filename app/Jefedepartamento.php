<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jefedepartamento extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'fechainicio', 'fechafin', 'docentejefe', 'docenteacademico_pege', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];

    public function docenteacademico() {
        return $this->belongsTo('App\Docenteacademico');
    }

    public function aplicarevaluacions() {
        return $this->hasMany('App\Aplicarevaluacion');
    }

}
