<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => ['required'],
            'description' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
