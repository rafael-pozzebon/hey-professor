<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, put};

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

it('should make sure that only question with status Draft can be update', function () {
    $user             = User::factory()->create();
    $questionNotDraft = Question::factory()->for($user, 'createdBy')->create(['draft' => false]);
    $questionDraft    = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    actingAs($user);

    put(route('question.update', $questionNotDraft), [
        'question' => 'New Description question?',
    ])->assertForbidden();

    put(route('question.update', $questionDraft), [
        'question' => 'New Description question?',
    ])->assertRedirect(route('question.index'));
});

it('should make sure that only the person who has created the question can update the question', function () {
    $rightUser = User::factory()->create();
    $wrongUser = User::factory()->create();
    $question  = Question::factory()->create(['draft' => true, 'created_by' => $rightUser->id]);

    actingAs($wrongUser);

    put(route('question.update', $question), [
        'question' => 'New Description?',
    ])
        ->assertForbidden();

    actingAs($rightUser);

    put(route('question.update', $question), [
        'question' => 'New Description?',
    ])
        ->assertRedirect(route('question.index'));
});

it('should be able to create a new question bigger than 255 characters', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    actingAs($user);

    $request = put(route('question.update', $question), [
        'question' => str_repeat('a', 260) . '?',
    ]);

    $request->assertRedirect();
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', [
        'question' => str_repeat('a', 260) . '?',
    ]);
});

it('should check if ends with a question mark ?', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    actingAs($user);

    $request = put(route('question.update', $question), [
        'question' => str_repeat('?', 9) . ".",
    ]);

    $request->assertSessionHasErrors([
        'question' => 'The question must end with a question mark?.',
    ]);

    assertDatabaseHas('questions', [
        'question' => $question->question,
    ]);
});

it('should have at least 10 characters', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    actingAs($user);

    put(route('question.update', $question), [
        'question' => 'a',
    ])->assertSessionHasErrors(['question' => __('validation.min.string', ['attribute' => 'question', 'min' => 10])]);

    // Assert
    assertDatabaseCount('questions', 1);
});

it('only authenticated user can create a new question', function () {
    $question = Question::factory()->create(['draft' => true]);
    put(route('question.update', $question), [
        'question' => str_repeat('a', 260) . '?',
    ])->assertRedirect(route('login'));
});
