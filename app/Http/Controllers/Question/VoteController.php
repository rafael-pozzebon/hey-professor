<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\{Question, Vote};

class VoteController extends Controller
{
    public function __invoke(Question $question_id): \Illuminate\Http\RedirectResponse
    {
        Vote::query()->create([
            'question_id' => $question_id->id,
            'user_id'     => auth()->id(),
            'like'        => 1,
        ]);

        return back();
    }
}
