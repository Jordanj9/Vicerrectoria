<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ppu extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'unidad_id', 'periodoacademico_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];

    public function unidad() {
        return $this->belongsTo('App\Unidad');
    }

    public function periodoacademico() {
        return $this->belongsTo('App\Periodoacademico');
    }

}
