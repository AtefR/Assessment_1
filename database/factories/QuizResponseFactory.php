<?php

namespace Database\Factories;

use App\Models\Quiz;
use App\Models\QuizResponse;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class QuizResponseFactory extends Factory
{
    protected $model = QuizResponse::class;

    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'response' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'quiz_id' => Quiz::factory(),
        ];
    }
}
