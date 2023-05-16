<?php

namespace App\Http\Controllers\Quetion;

use App\Http\Controllers\Controller;
use App\Models\{Question, Vote};
use Illuminate\Http\{RedirectResponse, Request};

class LikeController extends Controller
{
    public function __invoke(Question $question): RedirectResponse
    {
        auth()->user()->like($question);

        return back();
    }
}
