<div>
    <div class="flex flex-col gap-3">
        <div class="mb-8 text-lg font-semibold">{{ $product->english_name }}</div>
        <div class="flex items-center">
            <x-text-input wire:model.live.debounce.500ms="search" placeholder="{{ __('search') }}"/>
        </div>
        <div class="flex gap-5">
            @foreach($parameters as $parameter)
                <div class="w-1/5 px-4 py-2 border rounded-md text-sm">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold">{{ $parameter->english_name }}</span>
                        <input wire:model.live="selectedParameters"
                               value="{{ $parameter->id }}"
                               type="checkbox"
                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                    </div>
                </div>
            @endforeach
        </div>
        <div>
            {{ $parameters->links() }}
        </div>
    </div>
    <div class="flex flex-col w-full mt-5">
        @if(!empty($selectedParameters))
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Selected parameter') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Values') }}
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($selectedParameters as $parameterId)
                    <tr class="bg-white border-b border-gray-200">
                        <th scope="row" class="px-6 py-4 whitespace-nowrap">
                            {{ $this->getParameterName($parameterId) }}
                        </th>
                        <td class="flex px-6 py-4 gap-2">
                            @foreach($this->getParameterValues($parameterId) as $parameterValue)
                                <div class="w-48 px-4 py-2 border rounded-md text-sm">
                                    <div class="flex items-center justify-between">
                                        <span class="font-semibold">{{ $parameterValue->english_name }}</span>
                                        <input wire:model.live="selectedParameterValues.{{ $parameterId }}.{{ $parameterValue->id }}"
                                               value="{{ $parameterValue->id }}"
                                               type="checkbox"
                                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                    </div>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
    <div class="flex flex-row-reverse mt-8 gap-3">
        <x-primary-button wire:click="save">{{ __('Save') }}</x-primary-button>
        <x-secondary-button wire:click="cancel">{{ __('Cancel') }}</x-secondary-button>
    </div>
</div>