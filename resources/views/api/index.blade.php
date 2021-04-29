<x-account-layout>
    <x-slot name="header">
        <div class="d-none d-lg-block">
            <h1 class="h2 text-white"> {{ __('API Tokens') }}</h1>
        </div>
    </x-slot>

    @livewire('api.api-token-manager')
</x-account-layout>