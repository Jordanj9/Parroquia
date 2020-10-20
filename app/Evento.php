<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nombre', 'descripcion', 'fecha', 'lugar', 'responsable', 'administracion_id', 'pastoral_id', 'created_at', 'updated_at'
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

    public function pastoral() {
        return $this->belongsTo(Pastoral::class);
    }
}
