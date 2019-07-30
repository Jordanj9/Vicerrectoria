<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignarpar extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'docentea', 'docenteacademico_pege', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];

    public function docenteacademico() {
        return $this->belongsTo('App\Docenteacademico');
    }

}
