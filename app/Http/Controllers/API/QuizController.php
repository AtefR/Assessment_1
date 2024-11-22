<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuizResource;
use App\Models\Quiz;

class QuizController extends Controller
{
    public function index()
    {
        return QuizResource::collection(
            resource: Quiz::latest()
                ->paginate(15),
        );
    }
}
