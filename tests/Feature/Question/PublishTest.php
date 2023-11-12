<?php

it('should be able to publish a question', function () {
    $user     = \App\Models\User::factory()->create();
    $question = \App\Models\Question::factory()->create(['draft' => true]);

    \Pest\Laravel\actingAs($user);

    \Pest\Laravel\put(route('question.publish', $question))
        ->assertRedirect();

    $question->refresh();

    expect($question->draft)->toBeFalse();
});
