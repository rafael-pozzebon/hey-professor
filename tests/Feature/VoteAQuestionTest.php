<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas};

it('should be able to like a question', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->create();

    actingAs($user)
        ->post(route('question.vote', $question->id))
        ->assertRedirect();

    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'user_id'     => $user->id,
        'like'        => 1,
        'unlike'      => 0,
    ]);

});

todo('should be able to unlike a question');
