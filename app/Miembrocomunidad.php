<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Miembrocomunidad extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'categoria', 'aporte_para', 'aporte_mensual', 'anio_ingreso', 'fecha_censo_salud', 'estado', 'comunidad_id', 'miembro_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function comunidad() {
        return $this->belongsTo(Comunidad::class);
    }

    public function miembro() {
        return $this->belongsTo(Miembro::class);
    }

    public function miembrocomunidads() {
        return $this->hasMany(Miembrocomunidad::class);
    }
}
