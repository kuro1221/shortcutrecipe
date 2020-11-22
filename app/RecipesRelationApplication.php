<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecipesRelationApplication extends Model
{
    //
    protected $fillable = [
        'recipe_id', 'application_id'
    ];
}
