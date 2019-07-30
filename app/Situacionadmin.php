<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Situacionadmin extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'descripcion', 'tipo_retiro', 'inicial', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];

    public function histrabajadorlabors() {
        return $this->hasMany('App\Histrabajadorlabor');
    }
    
    public function trabajadorlabors() {
        return $this->hasMany('App\Histrabajadorlabor');
    }

}
