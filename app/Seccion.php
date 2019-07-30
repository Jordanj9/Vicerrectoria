<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seccion extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nombre', 'descripcion', 'porcentaje', 'grupoav_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];

    public function grupoav() {
        return $this->belongsTo('App\Grupoav');
    }

    public function temas() {
        return $this->hasMany('App\Tema');
    }

    public function actividads() {
        return $this->hasMany('App\Actividad');
    }

}
