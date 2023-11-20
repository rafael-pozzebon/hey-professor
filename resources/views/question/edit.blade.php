<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Question') }}
        </h2>
    </x-slot>

    <x-form action="{{route('question.update', $question)}}" put>
        <x-text-area name="question" :value="$question"/>
    </x-form>
</x-app-layout>
