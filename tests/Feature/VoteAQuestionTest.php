<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, post};

it('should be able to like a question', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->create();

    actingAs($user);

    post(route('question.like', $question));
    post(route('question.like', $question));
    post(route('question.like', $question));
    post(route('question.like', $question));

    expect($user->votes()->where('question_id', $question->id)->count())->toEqual(1);
});

it('should not be able to like more than 1 time', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->create();

    actingAs($user);

    post(route('question.like', $question));

    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'user_id'     => auth()->id(),
        'like'        => 1,
        'unlike'      => 0,
    ]);
});
