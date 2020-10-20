<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administracion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'fecha_inicio', 'fecha_fin', 'descripcion', 'nombre', 'estado', 'parroquia_id', 'created_at', 'updated_at'
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

    public function empleados() {
        return $this->hasMany(Empleado::class);
    }

    public function planpastorals() {
        return $this->hasMany(Planpastoral::class);
    }

    public function consejos() {
        return $this->hasMany(Consejo::class);
    }

    public function eventos() {
        return $this->hasMany(Evento::class);
    }
}
