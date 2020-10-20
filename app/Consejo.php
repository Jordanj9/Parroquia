<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consejo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'tipo', 'administracion_id', 'miembro_id', 'lider_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function miembro() {
        return $this->belongsTo(Miembro::class);
    }

    public function administracion() {
        return $this->belongsTo(Administracion::class);
    }

    public function lider() {
        return $this->belongsTo(Lider::class);
    }
}
