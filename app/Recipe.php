<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    //
    protected $fillable = [
        'recipe_name', 'comment', 'iCloud_link', 'reference_title', 'reference_url'
    ];

    public function applications()
    {
        return $this->belongsToMany('App\Application', 'recipes_relation_applications')->withTimestamps();
    }

    public function Products()
    {
        return $this->belongsToMany('App\Product', 'recipes_relation_products')->withTimestamps();
    }
}
