<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>
  <div class="py-12">
    <x-form post :action="route('question.store')">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-textarea label="Question" name="question" />
      </div>
      <x-btn.primary type="submit">
        Save
      </x-btn.primary>
      <x-btn.reset type="reset">
        Reset
      </x-btn.reset>
    </x-form>
  </div>
</x-app-layout>
