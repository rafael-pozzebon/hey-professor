<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @foreach($questions as $item)
        <x-question :question="$item"></x-question>
    @endforeach

    {{ $questions->withQueryString()->links() }}
</x-app-layout>
