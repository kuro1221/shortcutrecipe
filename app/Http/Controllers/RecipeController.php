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
        log::debug($request->all());
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
        $user_id = Auth::id();
        //レシピが存在しない、またはログインユーザーがレシピの作成者ではない、またはレシピが削除されている場合は不正とみなす
        if (!$recipe || $recipe->user_id !== $user_id  || $recipe->delete_flg !== 0)
            return redirect()->action('HomeController@index')->with('flash_message', '不正な値が入力されました');

        $select_application = RecipesRelationApplication::where("recipe_id", $id)
            ->get();
        $select_product = RecipesRelationProduct::where("recipe_id", $id)
            ->get();
        $select_situation = RecipesRelationSituation::where("recipe_id", $id)
            ->get();
        return view(
            'recipe.editRecipe',
            ['recipe' => $recipe, 'select_application' => $select_application, 'select_situation' => $select_situation, 'select_product' => $select_product]
        );
    }

    public function editRecipe($id, Request $request)
    {
        log::debug($request->all());
        //数値以外が入力された場合、不正な入力とみなす
        if (!is_numeric($id))
            return redirect()->action('HomeController@index')->with('flash_message', '不正な値が入力されました');
        $recipe = Recipe::find($id);
        $user_id = Auth::id();
        //レシピが存在しない、またはログインユーザーがレシピの作成者ではない、またはレシピが削除されている場合は不正とみなす
        if (!$recipe || $recipe->user_id !== $user_id  || $recipe->delete_flg !== 0)
            return redirect()->action('HomeController@index')->with('flash_message', '不正な値が入力されました');
        $this->validator($request->all())->validate();

        $recipe->fill($request->all());
        $recipe->save();
        $old_select_application = RecipesRelationApplication::where("recipe_id", $id)
            ->get();
        $old_select_product = RecipesRelationProduct::where("recipe_id", $id)
            ->get();
        $old_select_situation = RecipesRelationSituation::where("recipe_id", $id)
            ->get();

        //以下は選択したアプリや製品、状況を編集するための処理
        $this->editLoop($request->select_product, $old_select_product, "product", "product_id", $recipe->id);
        $this->editLoop($request->select_application, $old_select_application, "application", "application_id", $recipe->id);
        $this->editLoop($request->select_situation, $old_select_situation, "situation", "situation_id", $recipe->id);
        // return view(
        //     'recipe.editRecipe',
        //     ['recipe' => $recipe, 'select_application' => $select_application, 'select_situation' => $select_situation, 'select_product' => $select_product]
        // );
    }

    //選択したアプリや製品、状況を編集するための処理
    public function editLoop($datas, $old_select_datas, $type, $type_id, $recipe_id)
    {
        //選んだデータがなければ以前選択したデータは全て削除
        if (!$datas) {
            foreach ($old_select_datas as $old_select_data) {
                $old_select_data->delete();
            }
        }

        foreach ($datas as $data) {
            $match_flg = false;
            foreach ($old_select_datas as $old_select_data) {
                if (!in_array($old_select_data[$type_id], $datas)) { //今回選択されていないデータは削除
                    $old_select_data->delete();
                }
                if ($data === $old_select_data[$type_id]) {
                    $match_flg = true;
                }
            }
            if (!$match_flg) { //新たに選択されたデータを追加
                switch ($type) {
                    case "application":
                        $new_select_data = new RecipesRelationApplication;
                        $new_select_data->application_id = $data;
                        break;
                    case "situation":
                        $new_select_data = new RecipesRelationSituation;
                        $new_select_data->situation_id = $data;
                        break;
                    case "product":
                        $new_select_data = new RecipesRelationProduct;
                        $new_select_data->product_id = $data;
                        break;
                }
                $new_select_data->recipe_id = $recipe_id;
                $new_select_data->save();
            }
        }
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
