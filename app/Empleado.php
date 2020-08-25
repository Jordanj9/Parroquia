<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'cargo', 'nombres', 'apellidos', 'estado', 'tipo_documento', 'identificacion', 'sexo', 'direccion', 'barrio', 'telefono', 'celular', 'correo', 'administracion_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function administracion() {
        return $this->belongsTo(Administracion::class);
    }
}
