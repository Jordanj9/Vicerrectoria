<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criterioevaluacion extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nombre', 'descripcion', 'peso', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];

    public function indicadors() {
        return $this->hasMany('App\Indicador');
    }

}
