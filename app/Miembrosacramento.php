<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Miembrosacramento extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'lugar', 'sacramento_id', 'miembro_id', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function sacramento() {
        return $this->belongsTo(Sacramento::class);
    }

    public function miembro() {
        return $this->belongsTo(Miembro::class);
    }
}
