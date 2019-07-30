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
        'id', 'fechainicio', 'fechafin', 'personanatural_id', 'departamento_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];

    public function personanatural() {
        return $this->belongsTo('App\Personanatural');
    }

    public function departamento() {
        return $this->belongsTo('App\Departamento');
    }

    public function aplicarevaluacions() {
        return $this->hasMany('App\Aplicarevaluacion');
    }

}
