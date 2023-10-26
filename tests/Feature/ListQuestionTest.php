<?php

it('should access route questions', function () {



    $response = \Pest\Laravel\get(route('dashboard'));

    dd($response->getContent());
    $response->assertStatus(200);
});

todo('should list all questions');
