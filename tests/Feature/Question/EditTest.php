<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('shoul be able to open a question to edit it', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create();

    actingAs($user)
        ->get(route('question.edit', $question))
        ->assertSuccessful();
});

it('should be able to open a question to edit it', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    actingAs($user)
        ->get(route('question.edit', $question))
        ->assertViewIs('question.edit');
});

it('should make sure that only question with status Draft can be edited', function () {
    $user             = User::factory()->create();
    $questionNotDraft = Question::factory()->for($user, 'createdBy')->create(['draft' => false]);
    $questionDraft    = Question::factory()->for($user, 'createdBy')->create(['draft' => true]);

    actingAs($user);

    get(route('question.edit', $questionNotDraft))
        ->assertForbidden();

    get(route('question.edit', $questionDraft))
        ->assertSuccessful();
});
