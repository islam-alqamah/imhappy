<x-account-layout>
    <x-slot name="header">
        <div class="d-none d-lg-block">
            <h1 class="h2 text-white">{{ __('Team Settings') }}</h1>
        </div>
    </x-slot>

    @livewire('teams.update-team-name-form', ['team' => $team])

    @livewire('teams.team-member-manager', ['team' => $team])

    {{-- @livewire('teams.team-transfer-form', ['team' => $team]) --}}

    @if (Gate::check('delete', $team) && ! $team->personal_team)
        <x-jet-section-border />

        @livewire('teams.delete-team-form', ['team' => $team])
    @endif
</x-account-layout>