<?php

namespace App\Http\Controllers\API;

use App\Actions\SaveQuizResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuizResponseRequest;

class QuizResponseController extends Controller
{
    public function store(QuizResponseRequest $request)
    {
        SaveQuizResponse::execute($request);

        return response()->json([
            'success' => true,
        ], 201);
    }
}
