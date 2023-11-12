<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;

class UnlikeController extends Controller
{
    public function __invoke(Question $question): \Illuminate\Http\RedirectResponse
    {
        user()->unlike($question);

        return back();
    }
}
