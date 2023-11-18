<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should access route questions', function () {
    // Arrange
    $user = User::factory()->create();
    actingAs($user);

    //Act
    $request = get(route('dashboard'));

    // Assert
    $request->assertOk();
    $request->assertStatus(200);
});

it('should list all questions', function () {
    // Arrange
    $questions = Question::factory()->count(5)->create();

    $user = User::factory()->create();
    actingAs($user);

    //Act
    $response = get(route('dashboard'));

    // Assert
    /**
     * @var Question $item
     */
    foreach ($questions as $item) {
        $response->assertSee($item->question);
    }
});

it('should paginate the result', function () {
    // Arrange
    $questions = Question::factory()->count(20)->create();

    $user = User::factory()->create();
    actingAs($user);

    //Act
    $response = get(route('dashboard'))
        ->assertViewHas('questions', fn ($value) => $value instanceof \Illuminate\Pagination\LengthAwarePaginator);

});
