<?php

namespace App\Recipe\UseCase;

final class RecipeUnauthorizedAccessUseCase
{
    public function handle($recipe, $user_id)
    {
        //レシピが存在しない、またはログインユーザーがレシピの作成者ではない、またはレシピが削除されている場合は不正とみなす
        if (!$recipe || $recipe->user_id !== $user_id  || $recipe->delete_flg !== 0)
            return redirect()->action('RecipeController@recipeListShow')->with('flash_message', '不正な値が入力されました')->throwResponse();
    }
}
