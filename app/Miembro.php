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
        'numero_hijos', 'nombre_padres', 'fecha_anulacion_matrimonio', 'representante', 'colegio', 'grado', 'num_hermanos',
        'vivecon', 'direccion', 'barrio', 'telefono', 'celular', 'trabaja', 'empresa', 'habitacion', 'conquienvive',
        'entorno_material', 'acueducto', 'alcantarillado', 'luz', 'tel', 'sanitario', 'letrina', 'gas', 'no_hay',
        'antecedentes', 'estado_animico', 'estadocivil_id', 'ocupacion_id', 'created_at', 'updated_at'
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
        return $this->belongsTo(Estadocivil::class);
    }
}
