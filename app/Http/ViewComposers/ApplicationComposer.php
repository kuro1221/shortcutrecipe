<?php

namespace App\Http\ViewComposers;

use App\Application;
use Illuminate\Contracts\View\View;

class ApplicationComposer
{


    public function  __construct()
    {
        // $application_list = Application::where('delete_flg', false)->get();
    }

    public function compose(View $view)
    {
        $application_list = Application::where('delete_flg', false)->get();
        $view->with('application_list', $application_list);
    }
}
