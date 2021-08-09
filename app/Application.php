<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    //
    protected $fillable = ['application_name', 'delete_flg'];

    public function recipes()
    {
        return $this->belongsToMany('App\Recipe', 'recipes_relation_applications')->withTimestamps();
    }
}
