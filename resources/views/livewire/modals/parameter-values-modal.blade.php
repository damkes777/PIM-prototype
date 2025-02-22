<x-wire-modal>
    <x-slot:title>
        {{ __('Parameter values') }}
    </x-slot:title>
    <div class="w-full">
        @if($values->isEmpty())
            <p class="text-center text-sm text-gray-400">
                {{ __('The parameter has no value') }}
            </p>
        @else
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Base name (en)') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Names') }}
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($values as $value)
                    <tr class="bg-white border-b border-gray-200">
                        <th scope="row" class="px-6 py-4 whitespace-nowrap">
                            {{ $value->english_name }}
                        </th>
                        <td class="px-6 py-4">
                            <ul>
                                @foreach($value->names as $name)
                                    <li>
                                        <span class="font-bold">{{ $this->getLanguage($name->language) }}:</span>
                                        <span>{{ $name->name }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-wire-modal>