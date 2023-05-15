<?php

use App\Models\Question;

use function Pest\Laravel\get;

it('should list all the questions', function () {
    //Arrange
    //Criar algumas perguntas
    $user      = \App\Models\User::factory()->create();
    $questions = Question::factory()->count(5)->create();

    \Pest\Laravel\actingAs($user);

    //  act
    //  acessar a rota
    $response = get(route('dashboard'));

    //  assert
    //  verificar se a lista de perguntas está sendo mostrada
    /** @var Question $q */
    foreach ($questions as $q) {
        $response->assertSee($q->question);
    }
});
