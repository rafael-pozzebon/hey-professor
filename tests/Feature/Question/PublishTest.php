<?php

it('should be able to publish a question', function () {
    $user     = \App\Models\User::factory()->create();
    $question = \App\Models\Question::factory()->create([
        'draft'      => true,
        'created_by' => $user->id,
    ]);

    \Pest\Laravel\actingAs($user);

    \Pest\Laravel\put(route('question.publish', $question))
        ->assertRedirect();

    $question->refresh();

    expect($question->draft)->toBeFalse();
});

it('should make sure that only the person who has created the question can publish the question', function () {
    $rightUser = \App\Models\User::factory()->create();
    $wrongUser = \App\Models\User::factory()->create();
    $question  = \App\Models\Question::factory()->create(['draft' => true, 'created_by' => $rightUser->id]);

    \Pest\Laravel\actingAs($wrongUser);
    \Pest\Laravel\put(route('question.publish', $question))
        ->assertForbidden();

    \Pest\Laravel\actingAs($rightUser);
    \Pest\Laravel\put(route('question.publish', $question))
        ->assertRedirect();
});
