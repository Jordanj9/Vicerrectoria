<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPeriodo extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'descripcion', 'duracion_semanas', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];

    public function programas() {
        return $this->hasMany('App\Programa');
    }

    public function pensums() {
        return $this->hasMany('App\Pensum');
    }

    public function periodoacademicos() {
        return $this->hasMany('App\Periodoacademico');
    }
    
    public function cambiotpaprogs() {
        return $this->hasMany('App\Cambiotpaprog');
    }

}
