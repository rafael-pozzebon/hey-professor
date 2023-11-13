<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition(): array
    {
        return [
            'question'   => $this->faker->realTextBetween(10, 300) . '?',
            'created_by' => \App\Models\User::factory(),
            'draft'      => $this->faker->boolean,
        ];
    }
}
