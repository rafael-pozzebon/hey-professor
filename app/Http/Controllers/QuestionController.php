<?php

namespace App\Http\Controllers;

use App\Models\Question;

class QuestionController extends Controller
{
    public function store()
    {
        $this->validate(request(), [
            'question' => [
                'required',
                'min:10',
                function (string $attribute, mixed $value, \Closure $fail) {
                    if ($value[strlen($value) - 1] != '?') {
                        $fail(__('The question must end with a question mark?.'));
                    }
                },
            ],
        ]);

        Question::query()->create([
            'question' => request('question'),
        ]);

        return to_route('dashboard');
    }
}
