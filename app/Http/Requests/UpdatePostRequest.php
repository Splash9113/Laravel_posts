<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Router;

class UpdatePostRequest extends FormRequest
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
    public function rules(Router $router)
    {
        return [
            'title' => 'required|max:255|unique:posts,title,'.$router->input('post')->id,
            'body' => 'required',
            'active' => 'in:0,1'
        ];
    }
}
