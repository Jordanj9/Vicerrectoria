<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Panel extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'titulo', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];

    public function elementos() {
        return $this->hasMany('App\Elemento');
    }

    public function formularios() {
        return $this->hasMany('App\Formulario');
    }

}
