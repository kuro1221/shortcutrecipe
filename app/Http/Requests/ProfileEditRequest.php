<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ProfileEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'img' => ['nullable', 'file', 'mimes:png,jpeg,jpg,gif', 'max:85000'],
            'email' => ['required', 'string', 'email', 'max:50', Rule::unique('users', 'email')->whereNot('email', Auth::user()->email)],
            'name' => ['required', 'string', 'max:20'],
            'twitter' => ['nullable', 'string', 'max:100'],
            'website' => ['nullable', 'string', 'max:100'],
            'youtube' => ['nullable', 'string', 'max:100'],
            'instaglam' => ['nullable', 'string', 'max:100'],
            'comment' => ['nullable', 'max:250'],
        ];
    }
}
