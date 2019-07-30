<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fechaaplicacionevaluacion extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'fechainicio', 'fechafin', 'periodoacademico_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];

    public function periodoacademico() {
        return $this->belongsTo('App\Periodoacademico');
    }

}
