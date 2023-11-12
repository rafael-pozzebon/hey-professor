<?php

it('should access route questions', function () {
    // Arrange
    $user = \App\Models\User::factory()->create();
    \Pest\Laravel\actingAs($user);

    //Act
    $request = \Pest\Laravel\get(route('dashboard'));

    // Assert
    $request->assertOk();
    $request->assertStatus(200);
});

it('should list all questions', function () {
    // Arrange
    $questions = \App\Models\Question::factory()->count(10)->create();

    $user = \App\Models\User::factory()->create();
    \Pest\Laravel\actingAs($user);

    //Act
    $response = \Pest\Laravel\get(route('dashboard'));

    // Assert
    /**
     * @var \App\Models\Question $item
     */
    foreach ($questions as $item) {
        $response->assertSee($item->question);
    }
});
