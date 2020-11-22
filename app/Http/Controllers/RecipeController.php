<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\RecipesRelationApplication;
use App\RecipesRelationSituation;
use App\RecipesRelationProduct;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RecipeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addRecipeShow()
    {
        return view('recipe.addRecipe');
    }

    public function addRecipe(Request $request)
    {
        $this->validator($request->all())->validate();
        $recipe = new Recipe;
        $recipe->fill($request->all());
        $recipe->user_id = Auth::id();
        $recipe->save();

        //以下は選択したアプリや製品、状況を複数追加するための処理
        if ($request->select_application) $this->addLoop($request->select_application, "application", $recipe->id);
        if ($request->select_product) $this->addLoop($request->select_product, "product", $recipe->id);
        if ($request->select_situation) $this->addLoop($request->select_situation, "situation", $recipe->id);
    }

    //選択したアプリや製品、状況を複数追加するための処理
    public function addLoop($datas, $type, $recipe_id)
    {
        // log::debug($applications);
        foreach ($datas as $data) {
            if ($data) {
                switch ($type) {
                    case "application":
                        $select_data = new RecipesRelationApplication;
                        $select_data->application_id = $data;
                        break;
                    case "situation":
                        $select_data = new RecipesRelationSituation;
                        $select_data->situation_id = $data;
                        break;
                    case "product":
                        $select_data = new RecipesRelationProduct;
                        $select_data->product_id = $data;
                        break;
                }
                $select_data->recipe_id = $recipe_id;
                log::debug($select_data);
                $select_data->save();
            }
        }
    }

    public function editRecipeShow($id)
    {
        //数値以外が入力された場合、不正な入力とみなす
        if (!is_numeric($id))
            return redirect()->action('HomeController@index')->with('flash_message', '不正な値が入力されました');

        $recipe = Recipe::find($id);
        log::debug($id);
        return view('recipe.editRecipe');
    }

    protected function validator(array $data)
    {
        return  Validator::make($data, [
            'recipe_name' => ['required', 'string', 'max:50'],
            'iCloud_link' => ['required', 'string', 'max:100'],
            'comment' => ['sometimes', 'max:250']
        ]);
    }
}
