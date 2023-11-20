@props([
    'label', 'name', 'value' =>null,
    'question' => null
    ])

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @csrf
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Question</label>
                @error($name)
                <div class="text-red-500 mt-2 text-sm mb-2">
                    {{ $message }}
                </div>
                @enderror
                <textarea id="message" rows="4" name="{{$name}}"
                          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                          placeholder="Write your thoughts here...">{{old($name, $value)}}</textarea>

            </div>

            <x-button.default type="reset">Reset</x-button.default>

            <x-button.primary type="submit">Send Ask</x-button.primary>
        </div>
    </div>
</div>
