@if($this->hasCategory($row))
    <span>Category</span>
@else
    <x-secondary-button class="ml-1">
        {{ __('assign') }}
    </x-secondary-button>
@endif
