<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personajuridica extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'razonsocial', 'representantelegal', 'cargorepresentante', 'fax', 'autoretenedor', 'agenteretenedor', 'naturaleza', 'tipopersonajuridica', 'codigoempresaoficial', 'grancontribuyente', 'tipopersonaj_id', 'actividade_id', 'persona_id', 'regimen_id', 'created_at', 'updated_at'
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

    public function jefepracticas() {
        return $this->hasMany('App\Jefepractica');
    }

    public function persona() {
        return $this->belongsTo('App\Persona');
    }

    public function regimen() {
        return $this->belongsTo('App\Regimen');
    }

    public function actividade() {
        return $this->belongsTo('App\Actividade');
    }

    public function tipopersonaj() {
        return $this->belongsTo('App\Tipopersonaj');
    }

    public function institucions() {
        return $this->hasMany('App\Institucion');
    }

    public function empresapracticas() {
        return $this->hasMany('App\Empresapractica');
    }

}
