<?php

use App\Models\Quiz;
use App\Models\QuizResponse;
use function Pest\Laravel\postJson;

it('stores a quiz response successfully', function () {
    $quiz = Quiz::factory()->create();
    $data = [
        'email' => 'test@test.com',
        'response' => 'response',
        'quiz_id' => $quiz->id,
    ];

    $response = postJson('/api/quiz-responses', $data);

    $response->assertStatus(201)
        ->assertJson(['success' => true]);

    $this->assertDatabaseHas('quiz_responses', $data);
});

it('prevents duplicate quiz responses from the same email', function () {
    $quiz = Quiz::factory()->create();
    QuizResponse::factory()->create([
        'email' => 'test@test.com',
        'response' => 'response',
        'quiz_id' => $quiz->id,
    ]);

    $data = [
        'email' => 'test@test.com',
        'response' => 'another response',
        'quiz_id' => $quiz->id,
    ];

    $response = postJson('/api/quiz-responses', $data);

    $response->assertStatus(422)
    ->assertJsonValidationErrors(['email' => 'Quiz already responded']);

    $this->assertDatabaseMissing('quiz_responses', ['response' => 'Another response']);
});

it('validates required fields when storing a quiz response', function () {
    $response = postJson('/api/quiz-responses', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email', 'response', 'quiz_id']);
});
