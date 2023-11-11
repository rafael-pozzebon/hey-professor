<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, post};

it('should be able to like a question', function () {
    // Arrange
    $user     = User::factory()->create();
    $question = Question::factory()->create();

    //Act
    actingAs($user)
        ->post(route('question.like', $question->id))
        ->assertRedirect();

    // Assert
    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'user_id'     => $user->id,
        'like'        => 1,
        'unlike'      => 0,
    ]);

});

todo('should be able to unlike a question');

it('should be able to like a question only once', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->create();

    actingAs($user);

    post(route('question.like', $question->id));
    post(route('question.like', $question->id));
    post(route('question.like', $question->id));
    post(route('question.like', $question->id));

    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'user_id'     => $user->id,
        'like'        => 1,
        'unlike'      => 0,
    ]);

    expect($user->votes()->count())->toBe(1);
});
