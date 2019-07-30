<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variablerendimiento extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'descripcion', 'lista', 'nombretabla', 'nombrellave', 'nombredescripcion', 'reglarendimiento_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];

    public function reglarendimiento() {
        return $this->belongsTo('App\Reglarendimiento');
    }

    public function variablerendimientovalors() {
        return $this->hasMany('App\Variablerendimientovalor');
    }
    
}
