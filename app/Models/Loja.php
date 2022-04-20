<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loja extends Model
{
    protected $with = ['children'];

    protected $fillable = [
        'nome',
        'email'   
    ];

    public function children() {
        return $this->hasMany('App\Models\Produto');
     }
}