<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodoacademico extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'fechainicio', 'fechafin', 'anio', 'periodo', 'fechainicioclases', 'fechafinclases', 'tipo_periodo_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];
    
    public function aplicarevaluacions() {
        return $this->hasMany('App\Aplicarevaluacion');
    }
    
    public function inscripcionofertapracticas() {
        return $this->hasMany('App\Inscripcionofertapractica');
    }
    
    public function liquidacionpecuniarios() {
        return $this->hasMany('App\Liquidacionpecuniario');
    }
    
    public function registroacademicos() {
        return $this->hasMany('App\Registroacademico');
    }
    
    public function fechaevaluaciongrupos() {
        return $this->hasMany('App\Fechaevaluaciongrupo');
    }
    
    public function cancelacionsemestres() {
        return $this->hasMany('App\Cancelacionsemestre');
    }

    public function cancelacionmaterias() {
        return $this->hasMany('App\Cancelacionmateria');
    }

    public function hismatriculaacademicas() {
        return $this->hasMany('App\Hismatriculaacademica');
    }

    public function matriculaacademicas() {
        return $this->hasMany('App\Matriculaacademica');
    }

    public function grupos() {
        return $this->hasMany('App\Grupo');
    }

    public function demandas() {
        return $this->hasMany('App\Demanda');
    }

    public function promocions() {
        return $this->hasMany('App\Promocion');
    }

    public function liquidacions() {
        return $this->hasMany('App\Liquidacion');
    }

    public function gradogenerals() {
        return $this->hasMany('App\Gradogeneral');
    }

    public function transferenciainternas() {
        return $this->hasMany('App\Transferenciainterna');
    }

    public function transferenciaexternas() {
        return $this->hasMany('App\Transferenciaexterna');
    }

    public function cuentaestudiantes() {
        return $this->hasMany('App\Cuentaestudiante');
    }

    public function deudaestudiantes() {
        return $this->hasMany('App\Deudaestudiante');
    }

    public function incrementoliquidacionantiguos() {
        return $this->hasMany('App\Incrementoliquidacionantiguos');
    }

    public function asignacionrecursofisicounidads() {
        return $this->hasMany('App\Asignacionrecursofisicounidad');
    }

    public function TipoPeriodo() {
        return $this->belongsTo('App\TipoPeriodo');
    }

    public function servicioperiodos() {
        return $this->hasMany('App\Servicioperiodo');
    }

    public function ppus() {
        return $this->hasMany('App\Ppu');
    }

    public function periodoprogunidads() {
        return $this->hasMany('App\Periodoprogunidad');
    }

    public function convocatorias() {
        return $this->hasMany('App\Convocatoria');
    }

    public function estudiantepensums() {
        return $this->hasMany('App\Estudiantepensum');
    }

    public function grupoavs() {
        return $this->hasMany('App\Grupoav');
    }
    
    public function autorizarevaluacions() {
        return $this->hasMany('App\Autorizarevaluacion');
    }

}
