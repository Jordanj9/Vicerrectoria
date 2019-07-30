<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autorizarevaluacion extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'periodoacademico_id', 'evaluacionaah_id', 'rol', 'created_at', 'updated_at'
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

    public function evaluacionaah() {
        return $this->belongsTo('App\Evaluacionaah');
    }

}
