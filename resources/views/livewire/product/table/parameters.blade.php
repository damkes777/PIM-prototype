@if($this->hasParameters($row))
    <x-secondary-button class="ml-1">
        {{ __('Show') }}
    </x-secondary-button>
@else
    <x-secondary-button class="ml-1">
        {{ __('assign') }}
    </x-secondary-button>
@endif