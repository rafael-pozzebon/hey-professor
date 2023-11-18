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
    Question::factory()->count(20)->create();

    $user = User::factory()->create();
    actingAs($user);

    get(route('dashboard'))
        ->assertViewHas('questions', fn($value) => $value instanceof \Illuminate\Pagination\LengthAwarePaginator);
});

it('should order by like and unlike, most liked question should be at the top, most unliked questions should be in the bottom', function () {
    $user = User::factory()->create();
    $secondUser = User::factory()->create();
    Question::factory()->count(5)->create();

    $mostLikedQuestion = Question::find(3);
    $user->like($mostLikedQuestion);

    $mostUnlikedQuestion = Question::find(1);
    $secondUser->unlike($mostUnlikedQuestion);

    actingAs($user);

    get(route('dashboard'))
        ->assertViewHas('questions', function ($questions) {

            expect($questions)
                ->first()->id->toBe(3)
                ->and($questions)
                ->last()->id->toBe(1);

            return true;
        });
});
