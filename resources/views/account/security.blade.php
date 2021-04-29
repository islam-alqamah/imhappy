<x-account-layout>
    <x-slot name="header">
        <div class="d-none d-lg-block">
            <h1 class="h2 text-white">{{ __('Advance Security') }} 
            </h1>
        </div>
    </x-slot>

    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
        @livewire('profile.two-factor-authentication-form')
    @endif

    <x-jet-section-border />

    @livewire('profile.logout-other-browser-sessions-form')

    <x-jet-section-border />

    @livewire('profile.delete-user-form')
</x-account-layout>