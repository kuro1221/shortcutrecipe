<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function profileEditShow()
    {
        return view('user.profileEdit');
    }

    public function profileEdit(Request $request)
    {
        $user = Auth::user();
        $this->validator($request->all())->validate();
        $user->fill($request->all());
        $user->save();
    }

    public function passwordEdit(Request $request)
    {
        log::debug($request->all());
        $user = Auth::user();
        $this->passwordValidator($request->all())->validate();
        $user->password = Hash::make($request->password);
        $user->save();
        // $this->validator($request->all())->validate();
        // $user->fill($request->all());
        // $user->save();
    }

    protected function validator(array $data)
    {
        return  Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:50'],
            'name' => ['required', 'string', 'max:50'],
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