<?php

use App\Models\{Question, User};

use function Pest\Laravel\actingAs;

it('shoul be able to update a question', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    actingAs($user)
        ->put(route('question.update', $question), [
            'question' => 'New Description?',
        ])
        ->assertRedirect();

    $question->refresh();

    expect($question->question)->toBe('New Description?');
});
