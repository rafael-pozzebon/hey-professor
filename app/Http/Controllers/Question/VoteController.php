<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\{Question, Vote};

class VoteController extends Controller
{
    public function __invoke(Question $question): \Illuminate\Http\RedirectResponse
    {
        auth()->user()->like($question);

        return back();
    }
}
