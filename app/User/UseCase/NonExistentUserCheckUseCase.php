<?php

namespace App\User\UseCase;

final class NonExistentUserCheckUseCase
{
    public function handle($user)
    {
        //ユーザーが存在しない、またはユーザーが削除されている場合は不正とみなす
        if (!$user || $user->delete_flg !== 0)
            return redirect()->action('RecipeController@recipeListShow')->with('flash_message', '不正な値が入力されました')->throwResponse();
    }
}
