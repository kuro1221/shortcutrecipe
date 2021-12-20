<?php

namespace App\Recipe\UseCase;

use Illuminate\Support\Facades\Log;

use App\Recipe;
use App\User;
use App\RecipesRelationApplication;
use App\RecipesRelationSituation;
use App\RecipesRelationProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AddRecipeRequest;
use App\Http\Requests\EditRecipeRequest;

final class ParamNumericCheckUseCase
{
    public function handle($recipe_id)
    {
        //数値以外が入力された場合、不正な入力とみなす
        if (!is_numeric($recipe_id))
            return redirect()->action('RecipeController@recipeListShow')->with('flash_message', '不正な値が入力されました');
    }
}
