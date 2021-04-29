<x-account-layout>
    <x-slot name="header">
        <div class="d-none d-lg-block">
            <h1 class="h2 text-white">{{ __('Plans')  }}</h1>
        </div>
    </x-slot>

    <div class="card">
        <h5 class="card-header">{{ __('Our plans') }}</h5>

        <div class="card-body">
            <livewire:plan-list />
        </div>
    </div>

</x-account-layout>
