<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecipesRelationSituation extends Model
{
    //
    protected $fillable = [
        'recipe_id', 'situation_id'
    ];
}
