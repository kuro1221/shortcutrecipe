<?php

namespace App\Recipe\UseCase;

final class ParamNumericCheckUseCase
{
    public function handle($id)
    {
        //数値以外が入力された場合、不正な入力とみなす
        if (!is_numeric($id))
            return redirect()->action('RecipeController@recipeListShow')->with('flash_message', '不正な値が入力されました')->throwResponse();
    }
}
