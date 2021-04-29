<x-account-layout>
    <x-slot name="header">
        <div class="d-none d-lg-block">
            <h1 class="h2 text-white">  {{ __('Create Team') }}</h1>
        </div>
    </x-slot>

    @livewire('teams.create-team-form')
</x-account-layout>