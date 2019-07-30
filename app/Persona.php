<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'tipopersona', 'direccion', 'mail', 'celular', 'telefono', 'direccion2', 'telefono2', 'numero_documento', 'lugar_expedicion', 'fecha_expedicion', 'tipodoc_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];

    public function reservarecursofisicos() {
        return $this->hasMany('App\Reservarecursofisico');
    }

    public function cuentaestudiantes() {
        return $this->hasMany('App\Cuentaestudiante');
    }

    public function tipodoc() {
        return $this->belongsTo('App\Tipodoc');
    }

    public function ciudad() {
        return $this->belongsTo('App\Ciudad');
    }

    public function pais() {
        return $this->belongsTo('App\Pais');
    }

    public function actividade() {
        return $this->belongsTo('App\Actividade');
    }

    public function regimen() {
        return $this->belongsTo('App\Regimen');
    }

    public function personanaturals() {
        return $this->hasMany('App\Personanatural');
    }

    public function personajuridicas() {
        return $this->hasMany('App\Personajuridica');
    }

    public function trabajadors() {
        return $this->hasMany('App\Trabajador');
    }

    public function gradoestudiantepensums() {
        return $this->hasMany('App\Gradoestudiantepensum');
    }


}
