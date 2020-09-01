<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lider extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'identificacion', 'nombre', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function comunidadliders() {
        return $this->hasMany(Comunidadlider::class);
    }
}
