<?php

namespace App;

use App\Application;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Model;

class RecipesRelationApplication extends Model
{

    public $incrementing = true;

    //
    protected $fillable = [
        'recipe_id', 'application_id'
    ];
}
