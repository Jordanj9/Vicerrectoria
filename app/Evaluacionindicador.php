<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluacionindicador extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'evaluacionaah_id', 'indicador_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];

    public function evaluacionaah() {
        return $this->belongsTo('App\Evaluacionaah');
    }

    public function indicador() {
        return $this->belongsTo('App\Indicador');
    }
    
    public function Aplicarevaluaciondetalles() {
        return $this->hasMany('App\Aplicarevaluaciondetalle');
    }

}
