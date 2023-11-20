<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Question') }}
        </h2>
    </x-slot>

    <x-form action="{{route('question.store')}}" post>
        <x-text-area name="question"/>
    </x-form>

    <div class="mt-5 mx-6">
        <x-table>
            <x-table.thead name="thead">
                <tr>
                    <x-table.th>Questions</x-table.th>
                    <x-table.th>Actions</x-table.th>
                </tr>
            </x-table.thead>
            <tbody>
            @foreach($questions->where('draft', true) as $item)
                <x-table.tr>
                    <x-table.td>{{$item->question}}</x-table.td>
                    <x-table.td>
                        <x-form :action="route('question.publish', $item)" put>
                            <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Publicar</button>
                        </x-form>
                        <a href="{{route('question.edit', $item)}}" class="font-medium text-yellow-100 dark:text-yellow-100 hover:underline">
                            Editar
                        </a>
                        <x-form :action="route('question.destroy', $item)" delete onsubmit="return confirm('tem certeza?')">
                            <button type="submit" class="font-medium text-blue-600 dark:text-red-500 hover:underline">Deletar</button>
                        </x-form>
                    </x-table.td>
                </x-table.tr>
            @endforeach
            </tbody>
        </x-table>
    </div>

    <div class="mt-5 mx-6">
        <x-table>
            <x-table.thead name="thead">
                <tr>
                    <x-table.th>Questions</x-table.th>
                    <x-table.th>Actions</x-table.th>
                </tr>
            </x-table.thead>
            <tbody>
            @foreach($questions->where('draft', false) as $item)
                <x-table.tr>
                    <x-table.td>{{$item->question}}</x-table.td>
                    <x-table.td>
                        <x-form action="{{ route('question.destroy', $item) }}" delete onsubmit="return confirm('tem certeza?')">
                            <x-table.button type="submit">Delete</x-table.button>
                        </x-form>
                        <x-form :action="route('question.archive', $item)" patch>
                            <button type="submit" class="font-medium text-blue-600 dark:text-red-500 hover:underline">Arquivar</button>
                        </x-form>
                    </x-table.td>
                </x-table.tr>
            @endforeach
            </tbody>
        </x-table>
    </div>

    <div class="mt-5 mx-6">
        <x-table>
            <x-table.thead name="thead">
                <tr>
                    <x-table.th>Questions</x-table.th>
                    <x-table.th>Actions</x-table.th>
                </tr>
            </x-table.thead>
            <tbody>
            @foreach($archivedQuestions as $item)
                <x-table.tr>
                    <x-table.td>{{$item->question}}</x-table.td>
                    <x-table.td>
                        <x-form :action="route('question.restore', $item)" patch>
                            <button type="submit" class="font-medium text-green-600 dark:text-green-500 hover:underline">Restaurar</button>
                        </x-form>
                    </x-table.td>
                </x-table.tr>
            @endforeach
            </tbody>
        </x-table>
    </div>


</x-app-layout>
