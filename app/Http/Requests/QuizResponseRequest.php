<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizResponseRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'max:254'],
            'response' => ['required'],
            'quiz_id' => ['required', 'exists:quizzes,id'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
