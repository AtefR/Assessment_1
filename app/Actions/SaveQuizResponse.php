<?php

namespace App\Actions;

use App\Http\Requests\QuizResponseRequest;
use App\Models\QuizResponse;
use Illuminate\Validation\ValidationException;

class SaveQuizResponse
{
    public static function execute(QuizResponseRequest $request): void
    {
        $alreadyResponded = QuizResponse::where('quiz_id', $request->quiz_id)
            ->where('email', $request->email)
            ->first();

        if ($alreadyResponded) {
            throw ValidationException::withMessages([
                'email' => 'Quiz already responded'
            ]);
        }

        QuizResponse::create([
            'email' => $request->email,
            'response' => $request->response,
            'quiz_id' => $request->quiz_id,
        ]);
    }
}
