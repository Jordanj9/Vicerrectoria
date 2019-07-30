<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipodoc extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'descripcion', 'tipo_persona', 'abreviatura', 'tipo', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];

    public function personas() {
        return $this->hasMany('App\Persona');
    }
    
    public function aspirantes() {
        return $this->hasMany('App\Aspirante');
    }

}
