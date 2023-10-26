<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <form action="{{route('question.store')}}" method="post">
        <x-text-area name="question"/>
    </form>

    @foreach($questions as $item)
        <x-question>{{ $item->question }}</x-question>
    @endforeach
</x-app-layout>
