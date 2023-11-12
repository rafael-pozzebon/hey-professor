@props([
    'question'
])

<div class="py-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-5 text-gray-900 dark:text-gray-100 flex justify-between items-center">
                <span for="message" class="block text-sm font-medium text-gray-900 dark:text-white">
                    {{ $question->question }}
                </span>
                <div>
                    <x-form action="{{ route('question.like', $question) }}" id="form-like-{{$question->id}}">
                        <button class="flex items-start space-x-1 text-green-500" form="form-like-{{ $question->id }}">
                            <x-icons.thumbs-up class="w-5 text-green-500 cursor-pointer hover:text-green-300" />
                            <span>{{ $question->votes_sum_like ?: 0 }}</span>
                        </button>
                    </x-form>
                    <x-form action="{{ route('question.unlike', $question) }}" id="form-unlike-{{$question->id}}">
                        <button class="flex items-start space-x-1 text-red-500" form="form-unlike-{{$question->id}}">
                            <x-icons.thumbs-down class="w-5 text-red-500 cursor-pointer hover:text-red-300" />
                            <span>
                                {{ $question->votes_sum_unlike ?: 0 }}
                            </span>
                        </button>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</div>
