<?php

namespace App\User\UseCase;

use Illuminate\Support\Facades\Auth;


final class GuestUserNotAccessUseCase
{
    public function handle()
    {
        if (Auth::user()->email === env('GUEST_EMAIL')) {
            return redirect()->action('RecipeController@recipeListShow')->with('flash_message', 'ゲストユーザーはこの機能を利用できません')->throwResponse();
        }
        return true;
    }
}
