<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Situacionespiritual extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nombre', 'descripcion', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function miembrosituacions() {
        return $this->hasMany(Miembrosituacion::class);
    }
}
