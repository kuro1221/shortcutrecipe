<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = ['product_name', 'delete_flg'];

    // public function RecipeRelationProduct()
    // {
    //     return $this->belongsTo('App\RecipesRelationProduct');
    // }
    public function recipes()
    {
        return $this->belongsToMany('App\Recipe', 'recipes_relation_products')->withTimestamps();
    }
}
