<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Docenteacademico extends Model {

    protected $primaryKey = 'pege';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pege', 'codigo', 'puntos', 'fechainiciocategoria', 'cargo_id', 'personanatural_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];

    public function cargo() {
        return $this->belongsTo('App\Cargo');
    }

    public function Asignarpars() {
        return $this->hasMany('App\Asignarpar');
    }

    public function personanatural() {
        return $this->belongsTo('App\Personanatural');
    }

    public function docenteclasesemanals() {
        return $this->hasMany('App\Docenteclasesemanal');
    }

    public function coordinadorpracticas() {
        return $this->hasMany('App\Coordinadorpractica');
    }

    public function trabajador() {
        return $this->belongsTo('App\Trabajador');
    }

    public function categoriaescalafon() {
        return $this->belongsTo('App\Categoriaescalafon');
    }

    public function norma() {
        return $this->belongsTo('App\Norma');
    }

    public function docenteunidads() {
        return $this->hasMany('App\Docenteunidad');
    }

    public function grupoavs() {
        return $this->hasMany('App\Grupoav');
    }

    public function docenteexamens() {
        return $this->hasMany('App\Docenteexamen');
    }

}
