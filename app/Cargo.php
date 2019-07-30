<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'descripcion', 'codigo', 'nombre', 'tipo', 'numero_empleados', 'labordocente', 'representacion', 'tiene_funcion', 'norma_id', 'escalasalario_id', 'niveljerarquico_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];

    public function niveljerarquico() {
        return $this->belongsTo('App\Niveljerarquico');
    }

    public function norma() {
        return $this->belongsTo('App\Norma');
    }

    public function escalasalario() {
        return $this->belongsTo('App\Escalasalario');
    }

    public function unidads() {
        return $this->belongsToMany('App\Unidad');
    }

    public function trabajadorlaborunidads() {
        return $this->hasMany('App\Trabajadorlaborunidad');
    }

    public function trabajadorlabors() {
        return $this->hasMany('App\Trabajadorlabor');
    }

    public function docenteunidads() {
        return $this->hasMany('App\Docenteunidad');
    }

    public function docenteacademicos() {
        return $this->hasMany('App\Docenteacademico');
    }

}
