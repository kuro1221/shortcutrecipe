<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddRecipeRequest;
use App\Http\Requests\EditRecipeRequest;
use App\Recipe\UseCase\AddRecipeUseCase;
use App\Recipe\UseCase\EditRecipeUseCase;
use App\Recipe\UseCase\ParamNumericCheckUseCase;
use App\Recipe\UseCase\RecipeUnauthorizedAccessUseCase;
use Illuminate\Support\Facades\DB;


class RecipeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('recipeListShow');
    }

    public function addRecipeShow()
    {
        return view('recipe.addRecipe');
    }

    /**
     *  [POST]レシピ追加処理
     */
    public function addRecipe(AddRecipeRequest $request)
    {
        $addRecipeUseCase = new AddRecipeUseCase();
        $addRecipeUseCase->handle($request);
        session()->flash('flash_message', '登録しました');
    }

    /**
     *  [POST]レシピ編集画面表示
     *  @param int $recipe_id
     */
    public function editRecipeShow($recipe_id)
    {
        $paramNumericCheckUseCase = new ParamNumericCheckUseCase();
        $paramNumericCheckUseCase->handle($recipe_id);

        $recipe = Recipe::find($recipe_id);
        $user_id = Auth::id();
        $recipeUnauthorizedAccessUseCase = new RecipeUnauthorizedAccessUseCase();
        $recipeUnauthorizedAccessUseCase->handle($recipe, $user_id);

        return view(
            'recipe.editRecipe',
            ['recipe' => $recipe, 'select_application' => $recipe->applications, 'select_product' => $recipe->products]
        );
    }

    /**
     *  [POST]レシピ編集処理
     *  @param int $id
     */
    public function editRecipe($id, EditRecipeRequest $request)
    {
        $paramNumericCheckUseCase = new ParamNumericCheckUseCase();
        $paramNumericCheckUseCase->handle($id);

        $recipe = Recipe::find($id);
        $user_id = Auth::id();
        $recipeUnauthorizedAccessUseCase = new RecipeUnauthorizedAccessUseCase();
        $recipeUnauthorizedAccessUseCase->handle($recipe, $user_id);

        $editRecipeUseCase = new EditRecipeUseCase();
        $editRecipeUseCase->handle($recipe, $request);

        session()->flash('flash_message', '編集しました');
    }

    public function deleteRecipe($recipe_id)
    {
        $paramNumericCheckUseCase = new ParamNumericCheckUseCase();
        $paramNumericCheckUseCase->handle($recipe_id);

        $recipe = Recipe::find($recipe_id);
        $user_id = Auth::id();
        $recipeUnauthorizedAccessUseCase = new RecipeUnauthorizedAccessUseCase();
        $recipeUnauthorizedAccessUseCase->handle($recipe, $user_id);

        $recipe->delete_flg = true;
        $recipe->save();
        session()->flash('flash_message', '削除しました');
    }

    public function recipeListShow()
    {
        //ログイン中ではないユーザーでも閲覧できるように、$user変数に空のUserインスタンスを格納
        Auth::user() ? $user = AUth::user() : $user = new User;
        $recipes = Recipe::with(['products', 'applications'])->select('recipes.*', 'users.id as user_id', 'users.name', 'users.img')
            ->join('users', 'recipes.user_id', '=', 'users.id')
            ->where('recipes.delete_flg', false)->get();
        return view('recipe.recipeList', ['recipes' => $recipes, 'user' => $user]);
    }
}
