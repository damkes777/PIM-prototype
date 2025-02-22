<x-wire-modal>
    <x-slot:title>
        {{ __('Parameter names') }}
    </x-slot:title>
    <div class="w-full">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    {{ __('Language') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('Name') }}
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($names as $name)
                <tr class="bg-white border-b border-gray-200">
                    <th scope="row" class="px-6 py-4 whitespace-nowrap">
                        {{ $this->getLanguage($name->language) }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $name->name }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-wire-modal>