<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personanatural extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'primer_nombre', 'segundo_nombre', 'sexo', 'fecha_nacimiento', 'libreta_militar', 'rh', 'primer_apellido', 'segundo_apellido', 'distrito_militar', 'clase_libreta', 'vive', 'fax', 'persona_id', 'departamento_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];

    public function liquidacionpecuniarios() {
        return $this->hasMany('App\Liquidacionpecuniario');
    }

    public function asesors() {
        return $this->hasMany('App\Asesor');
    }

    public function jurados() {
        return $this->hasMany('App\Jurado');
    }

    public function estadocivil() {
        return $this->belongsTo('App\Estadocivil');
    }

    public function religion() {
        return $this->belongsTo('App\Religion');
    }

    public function persona() {
        return $this->belongsTo('App\Persona');
    }

    public function pais() {
        return $this->belongsTo('App\Pais');
    }

    public function ciudad() {
        return $this->belongsTo('App\Ciudad');
    }

    public function estudiantes() {
        return $this->hasMany('App\Estudiante');
    }

    public function jefedepartamentos() {
        return $this->hasMany('App\Jefedepartamento');
    }

    public function docenteacademicos() {
        return $this->hasMany('App\Docenteacademico');
    }

    public function departamento() {
        return $this->belongsTo('App\Departamento');
    }

}
