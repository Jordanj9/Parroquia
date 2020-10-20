<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Miembropastoral extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'pastoral_id', 'miembro_id', 'created_at', 'updated_at'
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

    public function pastoral() {
        return $this->belongsTo(Pastoral::class);
    }
}
