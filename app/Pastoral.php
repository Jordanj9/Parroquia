<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pastoral extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nombre', 'descripcion', 'parroquia_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function parroquia() {
        return $this->belongsTo(Parroquia::class);
    }

    public function subpastorals() {
        return $this->hasMany(Subpastoral::class);
    }

    public function comunidads() {
        return $this->hasMany(Comunidad::class);
    }

    public function miembropastorals() {
        return $this->hasMany(Miembropastoral::class);
    }

    public function planpastorals() {
        return $this->hasMany(Planpastoral::class);
    }

    public function eventos() {
        return $this->hasMany(Evento::class);
    }
}
