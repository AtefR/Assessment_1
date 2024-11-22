<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuizResponseRequest;
use App\Models\QuizResponse;
use Illuminate\Validation\ValidationException;

class QuizResponseController extends Controller
{
    public function store(QuizResponseRequest $request)
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

        return response()->json([], 201);
    }
}
