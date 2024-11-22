<?php

namespace App\Http\Controllers;

use App\Actions\SaveQuizResponse;
use App\Http\Requests\QuizResponseRequest;
use App\Models\Quiz;
use Inertia\Inertia;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::withCount('responses')
            ->latest()
            ->paginate(15);

        return Inertia::render('Home/Index', compact('quizzes'));
    }

    public function show(Quiz $quiz)
    {
        $quiz->loadCount('responses');

        return Inertia::render('Home/Quiz', compact('quiz'));
    }

    public function store(QuizResponseRequest $request)
    {
        SaveQuizResponse::execute($request);

        return to_route('home')
            ->with('status', ['type' => 'success', 'action' => 'Good job!', 'text' => 'Your response has been sent.']);
    }
}
