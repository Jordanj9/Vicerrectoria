<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Valoracionevalucionacademica extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'acronimo', 'valor_cualitativo', 'valor_cuat1', 'valor_cuat2', 'descripcion', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];

}
