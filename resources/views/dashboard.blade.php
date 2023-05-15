<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>
  <x-container>
    <x-form post :action="route('question.store')">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-textarea label="Question" name="question"/>
      </div>
      <x-btn.primary type="submit">
        Save
      </x-btn.primary>
      <x-btn.reset type="reset">
        Reset
      </x-btn.reset>
    </x-form>
    {{--  listagem das perguntas  --}}
    <hr class="border-blue-600 mt-5">
    <div class="ml-5 mt-5">
      <div class="dark:text-gray-300 uppercase font-bold mb-1">List of Questions</div>
      <div class="dark:text-gray-400 space-y-3">
        @foreach($questions as $key => $item)
          <x-question :question="$item" :key="$key" />
        @endforeach
      </div>
    </div>
  </x-container>
</x-app-layout>
