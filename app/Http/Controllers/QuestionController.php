<?php

namespace App\Http\Controllers;

use App\Models\Question;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::query()
            ->where('created_by', auth()->id())
            ->latest()
            ->get();

        return view('question.index', compact('questions'));
    }
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
            'question'   => request('question'),
            'created_by' => auth()->id(),
            'draft'      => true,
        ]);

        return redirect()->back();
    }

    public function edit(Question $question)
    {
        $this->authorize('update', $question);

        return view('question.edit', compact('question'));
    }

    public function destroy(Question $question)
    {
        $this->authorize('destroy', $question);

        $question->delete();

        return back();
    }
}
