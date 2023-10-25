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

todo('should check if ends with a question mark ?');

todo('should have at least 10 characters');
