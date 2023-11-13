<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;

class PublishController extends Controller
{
    public function __invoke(Question $question)
    {
        abort_unless(user()->can('publish', $question), 403);

        $question->update([
            'draft' => false,
        ]);

        return back();
    }
}
