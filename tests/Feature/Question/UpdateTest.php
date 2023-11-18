<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, put};

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
        'question' => 'New Description?',
    ])
        ->assertForbidden();

    put(route('question.update', $questionDraft), [
        'question' => 'New Description?',
    ])
        ->assertRedirect();
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
        ->assertRedirect();
});
