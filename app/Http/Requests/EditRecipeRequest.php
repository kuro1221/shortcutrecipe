<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditRecipeRequest extends FormRequest
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
            'recipe_name' => ['required', 'string', 'max:20'],
            'iCloud_link' => ['required', 'string', 'max:150'],
            'comment' => ['sometimes', 'max:250'],
            'reference_title' => ['sometimes', 'max:20'],
            'reference_url' => ['sometimes', 'max:150'],
        ];
    }
}
