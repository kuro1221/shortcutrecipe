<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecipesRelationProduct extends Model
{
    //    
    protected $fillable = [
        'recipe_id', 'product_id'
    ];
}
