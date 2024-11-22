<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuizResponse;

class QuizResponseController extends Controller
{
    public function destroy(QuizResponse $quizResponse)
    {
        $quizResponse->delete();

        return redirect()
            ->back()
            ->with('success', 'Quiz Response created successfully!');
    }
}
