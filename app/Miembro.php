<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Miembro extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'tipo_documento', 'identificacion', 'nombres', 'apellidos', 'sexo', 'fechanacimiento', 'edad', 'nombre_conyugue',
        'numero_hijos', 'nombre_padres_paternos','nombre_padres_maternos', 'fecha_matrimonio', 'casadopor', 'fecha_anulacion_matrimonio', 'representante', 'colegio', 'grado', 'num_hermanos',
        'vivecon', 'direccion', 'barrio', 'correo', 'telefono', 'celular', 'trabaja', 'empresa', 'habitacion', 'conquienvive',
        'entorno_material', 'acueducto', 'alcantarillado', 'luz', 'tel', 'sanitario', 'letrina', 'gas', 'no_hay',
        'antecedentes', 'estado_animico', 'comunidades', 'estadocivil_id', 'ocupacion_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function estadocivil() {
        return $this->belongsTo(Estadocivil::class);
    }

    public function ocupacion() {
        return $this->belongsTo(ocupacion::class);
    }

    public function miembrocomunidads() {
        return $this->hasMany(Miembrocomunidad::class);
    }

    public function miembrosacramentos() {
        return $this->hasMany(Miembrosacramento::class);
    }

    public function miembrosituacions() {
        return $this->hasMany(Miembrosituacion::class);
    }

    public function miembropastorals() {
        return $this->hasMany(Miembropastoral::class);
    }

    public function consejos() {
        return $this->hasMany(Consejo::class);
    }
}
