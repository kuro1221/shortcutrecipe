<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\RecipesRelationApplication;
use App\RecipesRelationProduct;
use App\Http\Controllers\RecipeController;

class UserController extends Controller
{
    //
    public function userDetailShow($id)
    {
        //数値以外が入力された場合、不正な入力とみなす
        if (!is_numeric($id))
            return redirect()->action('RecipeController@recipeListShow')->with('flash_message', '不正な値が入力されました');
        $user = User::find($id);
        //ユーザーが存在しない、またはユーザーが削除されている場合は不正とみなす
        if (!$user || $user->delete_flg !== 0)
            return redirect()->action('RecipeController@recipeListShow')->with('flash_message', '不正な値が入力されました');

        Auth::user() ? $login_user = Auth::user() : $login_user = new User;

        $recipes = Recipe::select('recipes.*', 'users.id as user_id', 'users.name', 'users.img')
            ->join('users', 'recipes.user_id', '=', 'users.id')
            ->where('user_id', $user->id)
            ->where('recipes.delete_flg', false)->get();

        $select_products = RecipesRelationProduct::select()
            ->join('products', 'recipes_relation_products.product_id', '=', 'products.id')
            ->get();

        $select_applications = RecipesRelationApplication::select()
            ->join('applications', 'recipes_relation_applications.application_id', '=', 'applications.id')
            ->get();

        RecipeController::relationStoring($recipes, $select_products, "select_products");
        RecipeController::relationStoring($recipes, $select_applications, "select_applications");

        return view('user.userDetail', ['recipes' => $recipes, 'user' => $user, 'login_user' => $login_user]);
    }


    public function profileEditShow()
    {
        return view('user.profileEdit');
    }

    public function passwordEditShow()
    {
        return view('user.passwordEdit');
    }

    public function profileEdit(Request $request)
    {
        $user = Auth::user();
        $this->validator($request->all())->validate();
        //画像アップロード処理
        if (!empty($request->img)) {
            if ($request->file('img')->isValid()) {
                $filePath = $request->file('img')->store('public');
            }
            $user->img = str_replace('public/', '', $filePath);
        }
        $user->fill($request->all());
        $user->save();
        session()->flash('flash_message', '編集しました');
    }

    public function passwordEdit(Request $request)
    {
        $user = Auth::user();
        $this->passwordValidator($request->all())->validate();
        $user->password = Hash::make($request->password);
        $user->save();
        session()->flash('flash_message', 'パスワードを変更しました');
    }

    public function withdrawalShow()
    {
        return view('user.withdrawal');
    }

    public function withdrawal()
    {
        $user = Auth::user();
        log::debug("退会");
        $user->forceDelete();
        // $user->delete_flg = true;
        // $user->save();
        // Auth::logout();
        session()->flash('flash_message', '退会しました');
    }

    protected function validator(array $data)
    {
        return  Validator::make($data, [
            'img' => ['nullable', 'file', 'mimes:png,jpeg,jpg,gif', 'max:85000'],
            'email' => ['required', 'string', 'email', 'max:50', Rule::unique('users', 'email')->whereNot('email', Auth::user()->email)],
            'name' => ['required', 'string', 'max:20'],
            'twitter' => ['nullable', 'string', 'max:100'],
            'website' => ['nullable', 'string', 'max:100'],
            'youtube' => ['nullable', 'string', 'max:100'],
            'instaglam' => ['nullable', 'string', 'max:100'],
            'comment' => ['nullable', 'max:250'],
        ]);
    }

    //パスワード編集バリデーション処理
    public function passwordValidator(array $data)
    {
        $hashed_password = Auth::user()->password;
        return Validator::make($data, [
            'old_password' => ['required', 'string', 'min:8', 'max:50', "password_hash_check:$hashed_password"],
            'password' => ['required', 'string', 'min:8', 'max:50', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8', 'max:50'],
        ]);
    }
}
