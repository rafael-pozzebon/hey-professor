<?php

it('should be able to like a question', function () {
    $user     = \App\Models\User::factory()->create();
    $question = \App\Models\Question::factory()->create();

    \Pest\Laravel\actingAs($user);

    \Pest\Laravel\post(route('question.like', $question))->assertRedirect();

    \Pest\Laravel\assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'user_id'     => auth()->id(),
        'like'        => 1,
        'unlike'      => 0,
    ]);
});
