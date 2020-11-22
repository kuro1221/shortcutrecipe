<?php

namespace App\Http\ViewComposers;

use App\Situation;
use Illuminate\Contracts\View\View;

class SituationComposer
{

    public function  __construct()
    {
    }

    public function compose(View $view)
    {
        $situation_list = Situation::where('delete_flg', false)->get();
        $view->with('situation_list', $situation_list);
    }
}
