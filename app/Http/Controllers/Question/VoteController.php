<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\{Question, Vote};

class VoteController extends Controller
{
    public function __invoke(Question $question): \Illuminate\Http\RedirectResponse
    {
        user()->like($question);

        return back();
    }
}
