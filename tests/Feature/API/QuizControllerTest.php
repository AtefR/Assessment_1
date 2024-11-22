<?php

use App\Models\Quiz;

it('returns a paginated list of quizzes', function () {
    Quiz::factory()->count(20)->create();

    $response = $this->get('/api/quizzes');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'title', 'description'],
            ],
            'meta' => ['current_page', 'last_page', 'per_page', 'total'],
        ])
        ->assertJsonCount(15, 'data');
});
