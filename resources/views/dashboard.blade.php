<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <x-form action="{{route('question.store')}}">
        <x-text-area name="question"/>
    </x-form>

    @foreach($questions as $item)
        <x-question :question="$item"></x-question>
    @endforeach
</x-app-layout>
