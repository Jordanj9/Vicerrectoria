<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluacionaah extends Model {

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

    public function aplicarevaluacions() {
        return $this->hasMany('App\Aplicarevaluacion');
    }

    public function evaluacionindicadors() {
        return $this->hasMany('App\Evaluacionindicador');
    }

}
