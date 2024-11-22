<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuizRequest;
use App\Models\Quiz;
use Inertia\Inertia;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::latest()->paginate(15);

        return Inertia::render('Quizzes/Index', compact('quizzes'));
    }

    public function show(Quiz $quiz)
    {
        $responses = $quiz->responses()->latest()->paginate(15);

        return inertia('Quizzes/Show', compact('quiz', 'responses'));
    }

    public function store(QuizRequest $request)
    {
        Quiz::create($request->only(['title', 'description']));

        return redirect()
            ->route('quizzes.index')
            ->with('success', 'Quiz created successfully!');
    }

    public function update(QuizRequest $request, Quiz $quiz)
    {
        $quiz->update($request->only(['title', 'description']));

        return redirect()
            ->route('quizzes.index')
            ->with('success', 'Quiz updated successfully!');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()
            ->route('quizzes.index')
            ->with('success', 'Quiz deleted successfully!');
    }
}
