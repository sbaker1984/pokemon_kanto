<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
        protected $fillable = [
            'pokedex_number',
            'name',
            'height',
            'weight',
            'abilities',
            'forms',
            'moves',
            'species',
            'sprites',
            'stats',
            'types'
        ];
}
