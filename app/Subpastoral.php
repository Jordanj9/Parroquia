<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subpastoral extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nombre', 'descripcion', 'pastoral_id', 'created_at', 'updated_at'
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

    public function comunidads() {
        return $this->hasMany(Comunidad::class);
    }
}
