<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comunidad extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'numero', 'dia', 'hora', 'sala', 'pastoral_id', 'subpastoral_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function pastoral()
    {
        return $this->belongsTo(Pastoral::class);
    }

    public function subpastoral()
    {
        return $this->belongsTo(Subpastoral::class);
    }

    public function comunidadliders()
    {
        return $this->hasMany(Comunidadlider::class);
    }

    public function miembrocomunidads()
    {
        return $this->hasMany(Miembrocomunidad::class);
    }
}
