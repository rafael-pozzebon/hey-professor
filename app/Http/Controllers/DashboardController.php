<?php

namespace App\Http\Controllers;

use App\Models\Question;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('dashboard', [
            'questions' => Question::query()->withSum('votes', 'like')
                ->withSum('votes', 'unlike')
                ->latest()
                ->paginate(5),
        ]);
    }
}
