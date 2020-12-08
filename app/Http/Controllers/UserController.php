<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    protected function validator(array $data)
    {
        return  Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:50'],
            'name' => ['required', 'string', 'max:50'],
            'twitter' => ['nullable', 'string', 'max:100'],
            'website' => ['nullable', 'string', 'max:100'],
            'youtube' => ['nullable', 'string', 'max:100'],
            'instaglam' => ['nullable', 'string', 'max:100'],
            'comment' => ['nullable', 'max:250']
        ]);
    }
}
