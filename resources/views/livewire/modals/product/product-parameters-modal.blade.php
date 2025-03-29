<x-wire-modal>
    <x-slot:title>
        {{ __('Product parameters') }}
    </x-slot:title>
    <div class="w-full">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    {{ __('Parameter') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Values') }}
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($parameters as $parameterId => $valuesIds)
                <tr class="bg-white border-b border-gray-200">
                    <th scope="row" class="px-6 py-4 whitespace-nowrap">
                        {{ $this->getParameterName($parameterId) }}
                    </th>
                    <td class="px-6 py-4">
                        <ul>
                            @foreach($valuesIds as $valueId)
                                <li>
                                    {{ $this->getValueName($valueId) }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-wire-modal>