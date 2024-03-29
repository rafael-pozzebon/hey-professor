<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Rules\SameQuestionRule;
use Closure;

class QuestionController extends Controller
{
    public function index()
    {
        return view('question.index', [
            'questions'         => user()->questions,
            'archivedQuestions' => user()->questions()->onlyTrashed()->get(),
        ]);
    }

    public function store()
    {
        request()->validate([
            'question' => [
                'required',
                'min:10',
                function (string $attribute, mixed $value, Closure $fail) {
                    if ($value[strlen($value) - 1] != '?') {
                        $fail('Are you sure that is a question? It is missing the question mark in the end.');
                    }
                },
                new SameQuestionRule(),
            ],
        ]);

        user()->questions()
            ->create([
                'question' => request()->question,
                'draft'    => true,
            ]);

        return back();
    }

    public function edit(Question $question)
    {
        $this->authorize('update', $question);

        return view('question.edit', compact('question'));
    }

    public function update(Question $question)
    {
        $this->authorize('update', $question);

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

        $question->update([
            'question' => request('question'),
        ]);

        return to_route('question.index');
    }

    public function archive(Question $question)
    {
        $this->authorize('destroy', $question);

        $question->delete();

        return back();
    }

    public function restore(int $id)
    {
        $question = Question::withTrashed()->findOrFail($id);

        $this->authorize('destroy', $question);

        $question->restore();

        return back();
    }

    public function destroy(Question $question)
    {
        $this->authorize('destroy', $question);

        $question->forceDelete();

        return back();
    }
}
