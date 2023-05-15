@props([
    'question', 'key'
])

<div class="rounded dark:bg-gray-800/50 shadow shadow-blue-500/50 p-3 dark:text-gray-300 ">
  {{ $key + 1 }} - {{ $question->question }}
</div>
