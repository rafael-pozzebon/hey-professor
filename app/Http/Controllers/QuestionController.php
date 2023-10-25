<?php

namespace App\Http\Controllers;

use App\Models\Question;

class QuestionController extends Controller
{
    public function store()
    {
        $this->validate(request(), [
            'question' => 'required',
        ]);

        Question::query()->create([
            'question' => request('question'),
        ]);

        return to_route('dashboard');
    }
}
