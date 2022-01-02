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
use App\User\UseCase\GuestUserNotAccessUseCase;
use App\Recipe\UseCase\ParamNumericCheckUseCase;
use App\User\UseCase\NonExistentUserCheckUseCase;
use App\Http\Requests\ProfileEditRequest;
use App\Http\Requests\PasswordEditRequest;

class UserController extends Controller
{
    public function userDetailShow($id)
    {

        $paramNumericCheckUseCase = new ParamNumericCheckUseCase();
        $paramNumericCheckUseCase->handle($id); //数値以外が入力された場合、不正な入力とみなす


        $user = User::find($id);
        $nonExistentUserCheckUseCase = new NonExistentUserCheckUseCase();
        $nonExistentUserCheckUseCase->handle($user); //ユーザーが存在しない、またはユーザーが削除されている場合は不正とみなす

        Auth::user() ? $login_user = Auth::user() : $login_user = new User;
        $recipes = Recipe::with(['products', 'applications'])->select('recipes.*', 'users.id as user_id', 'users.name', 'users.img')
            ->join('users', 'recipes.user_id', '=', 'users.id')
            ->where('user_id', $user->id)
            ->where('recipes.delete_flg', false)->get();
        return view('user.userDetail', ['recipes' => $recipes, 'user' => $user, 'login_user' => $login_user]);
    }


    public function profileEditShow()
    {
        $guestUserNotAccessUseCase = new GuestUserNotAccessUseCase();
        $guestUserNotAccessUseCase->handle();
        return view('user.profileEdit');
    }

    public function passwordEditShow()
    {
        $guestUserNotAccessUseCase = new GuestUserNotAccessUseCase();
        $guestUserNotAccessUseCase->handle();
        return view('user.passwordEdit');
    }

    public function profileEdit(ProfileEditRequest $request)
    {
        $user = Auth::user();
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

    public function passwordEdit(PasswordEditRequest $request)
    {
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();
        session()->flash('flash_message', 'パスワードを変更しました');
    }

    public function withdrawalShow()
    {
        $guestUserNotAccessUseCase = new GuestUserNotAccessUseCase();
        $guestUserNotAccessUseCase->handle();
        return view('user.withdrawal');
    }

    public function withdrawal()
    {
        $user = Auth::user();
        $user->forceDelete();
        session()->flash('flash_message', '退会しました');
    }
}
