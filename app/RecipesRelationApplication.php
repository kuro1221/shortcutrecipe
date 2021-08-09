<?php

namespace App;

use App\Application;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RecipesRelationApplication extends Pivot
{

    public $incrementing = true;

    //
    protected $fillable = [
        'recipe_id', 'application_id'
    ];
}
