<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variablerendimientovalor extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'valor', 'pensumreglarendimiento_id', 'variablerendimiento_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];

    public function pensumreglarendimiento() {
        return $this->belongsTo('App\Pensumreglarendimiento');
    }

    public function variablerendimiento() {
        return $this->belongsTo('App\Variablerendimiento');
    }

}
