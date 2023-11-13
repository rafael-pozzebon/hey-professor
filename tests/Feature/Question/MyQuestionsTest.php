<?php

it('should be able to list all question created by me', function () {
    $wrongUser      = \App\Models\User::factory()->create();
    $wrongQuestions = \App\Models\Question::factory()->count(10)->create([
        'created_by' => $wrongUser->id,
    ]);

    $user      = \App\Models\User::factory()->create();
    $questions = \App\Models\Question::factory()->count(10)->create([
        'created_by' => $user->id,
    ]);

    \Pest\Laravel\actingAs($user);

    $response = \Pest\Laravel\get(route('question.index'));

    /**
     * @var \App\Models\Question $item
     */
    foreach ($questions as $item) {
        $response->assertSee($item->question);
    }

    /**
     * @var \App\Models\Question $item
     */
    foreach ($wrongQuestions as $item) {
        $response->assertDontSee($item->question);
    }
});
