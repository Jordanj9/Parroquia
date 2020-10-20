<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planpastoral extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'archivo', 'descripcion', 'pastoral_id', 'administracion_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function pastoral() {
        return $this->belongsTo(Pastoral::class);
    }

    public function administracion() {
        return $this->belongsTo(Administracion::class);
    }

}
