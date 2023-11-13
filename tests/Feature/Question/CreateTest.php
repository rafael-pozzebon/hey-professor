<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

it('should be able to create a new question bigger than 255 characters', function () {
    // Arrange
    $user = User::factory()->create();
    actingAs($user);

    //Act
    $request = post(route('question.store'), [
        'question' => str_repeat('a', 260) . '?',
    ]);

    // Assert
    $request->assertRedirect(route('dashboard'));
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', [
        'question' => str_repeat('a', 260) . '?',
    ]);
});

it('should check if ends with a question mark ?', function () {
    // Arrange
    $user = User::factory()->create();
    actingAs($user);

    //Act
    $request = post(route('question.store'), [
        'question' => str_repeat('?', 9) . ".",
    ]);

    // Assert
    $request->assertSessionHasErrors([
        'question' => 'The question must end with a question mark?.',
    ]);
    assertDatabaseCount('questions', 0);
});

it('should have at least 10 characters', function () {
    // Arrange
    $user = User::factory()->create();
    actingAs($user);

    //Act
    $request = post(route('question.store'), [
        'question' => 'a',
    ]);

    // Assert
    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['attribute' => 'question', 'min' => 10])]);
    assertDatabaseCount('questions', 0);
});

test('only authenticated user can create a new question', function () {
    post(route('question.store'), [
        'question' => str_repeat('a', 260) . '?',
    ])->assertRedirect(route('login'));
});
