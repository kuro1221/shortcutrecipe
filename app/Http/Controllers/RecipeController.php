<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\User;
use App\RecipesRelationApplication;
use App\RecipesRelationSituation;
use App\RecipesRelationProduct;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AddRecipeRequest;
use App\Http\Requests\EditRecipeRequest;
use App\Recipe\UseCase\ParamNumericCheckUseCase;
use App\Recipe\UseCase\AddRecipeUseCase;
use App\Recipe\UseCase\EditRecipeUseCase;
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
        // //数値以外が入力された場合、不正な入力とみなす
        if (!is_numeric($recipe_id))
            return redirect()->action('RecipeController@recipeListShow')->with('flash_message', '不正な値が入力されました');
        // $useCase = new ParamNumericCheckUseCase();
        // if ($useCase)
        //     return $useCase->handle($recipe_id);
        // (new ParamNumericCheckUseCase())->handle($recipe_id);
        $recipe = Recipe::find($recipe_id);
        $user_id = Auth::id();
        // //レシピが存在しない、またはログインユーザーがレシピの作成者ではない、またはレシピが削除されている場合は不正とみなす
        if (!$recipe || $recipe->user_id !== $user_id  || $recipe->delete_flg !== 0)
            return redirect()->action('RecipeController@recipeListShow')->with('flash_message', '不正な値が入力されました');

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
        //数値以外が入力された場合、不正な入力とみなす
        if (!is_numeric($id))
            return redirect()->action('RecipeController@recipeListShow')->with('flash_message', '不正な値が入力されました');
        $recipe = Recipe::find($id);
        $user_id = Auth::id();
        //レシピが存在しない、またはログインユーザーがレシピの作成者ではない、またはレシピが削除されている場合は不正とみなす
        if (!$recipe || $recipe->user_id !== $user_id  || $recipe->delete_flg !== 0)
            return redirect()->action('RecipeController@recipeListShow')->with('flash_message', '不正な値が入力されました');

        $editRecipeUseCase = new EditRecipeUseCase();
        $editRecipeUseCase->handle($recipe, $request);

        session()->flash('flash_message', '編集しました');
    }

    public function deleteRecipe($recipe_id)
    {
        //数値以外が入力された場合、不正な入力とみなす
        if (!is_numeric($recipe_id))
            return redirect()->action('RecipeController@recipeListShow')->with('flash_message', '不正な値が入力されました');
        $recipe = Recipe::find($recipe_id);
        $user_id = Auth::id();
        //レシピが存在しない、またはログインユーザーがレシピの作成者ではない、またはレシピが削除されている場合は不正とみなす
        if (!$recipe || $recipe->user_id !== $user_id  || $recipe->delete_flg !== 0)
            return redirect()->action('RecipeController@recipeListShow')->with('flash_message', '不正な値が入力されました');

        $recipe->delete_flg = true;
        $recipe->save();
        session()->flash('flash_message', '削除しました');
    }

    public function recipeListShow()
    {
        //ログイン中ではないユーザーでも閲覧できるように、$user変数に空のUserインスタンスを格納
        Auth::user() ? $user = AUth::user() : $user = new User;
        $recipes = Recipe::with(['products', 'applications'])->where('recipes.delete_flg', false)->get();
        return view('recipe.recipeList', ['recipes' => $recipes, 'user' => $user]);
    }

    // public static function relationStoring($recipes, $relations, $type)
    // {
    //     foreach ($recipes as $recipe) {
    //         $tempArray = array();
    //         foreach ($relations as $relation) {
    //             if ($relation->recipe_id == $recipe->id) {
    //                 array_push($tempArray, $relation);
    //             }
    //         }
    //         $recipe[$type] = $tempArray;
    //     }
    //     return $recipes;
    // }

    // protected function validator(array $data)
    // {
    //     return  Validator::make($data, [
    //         'recipe_name' => ['required', 'string', 'max:20'],
    //         'iCloud_link' => ['required', 'string', 'max:150'],
    //         'comment' => ['sometimes', 'max:250']
    //     ]);
    // }
}
