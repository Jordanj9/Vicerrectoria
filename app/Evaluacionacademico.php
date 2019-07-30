<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluacionacademico extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'descripcion', 'peso', 'opcional', 'orden', 'alcance', 'tipo', 'esfinal', 'sistemaevalucion_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];
    
    public function hiscalificacions() {
        return $this->hasMany('App\Hiscalificacion');
    }
    
    public function calificacions() {
        return $this->hasMany('App\Calificacion');
    }
    
    public function fechaevaluaciongrupos() {
        return $this->hasMany('App\Fechaevaluaciongrupo');
    }

    public function sistemaevalucion() {
        return $this->belongsTo('App\Sistemaevalucion');
    }

}
