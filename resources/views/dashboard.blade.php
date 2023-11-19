<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="my-6 mx-7">
        <form action="{{ route('dashboard') }}" method="get">
            @csrf
            <x-text-input name="search" value="{{ request()->search }}"></x-text-input>
            <x-button.primary type="submit">Search</x-button.primary>
        </form>
    </div>



    @forelse($questions as $item)
        <x-question :question="$item"></x-question>
    @empty
        <div class="my-6 mx-7">
            <x-draw.empty />
            <p class="text-gray-500 dark:text-gray-400">No questions found</p>
        </div>


    @endforelse


    {{ $questions->withQueryString()->links() }}
</x-app-layout>
