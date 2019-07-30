<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipopersonaj extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'descripcion', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
            //
    ];
    
    public function personajuridicas() {
        return $this->hasMany('App\Personajuridica');
    }

}
