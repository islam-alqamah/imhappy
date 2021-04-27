<x-jet-form-section submit="updateTeamName">
    <x-slot name="title">
        {{ __('Update Team') }}
    </x-slot>

    <x-slot name="description">
        {{ __('The team\'s name and owner information.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Team Owner Information -->
        <div class="mb-4">
            <x-jet-label value="{{ __('Team Owner') }}" />

            <div class="d-flex mt-2">
                <img class="rounded-circle" width="48" src="{{ $team->owner->profile_photo_url }}">

                <div class="ml-2">
                    <div>{{ $team->owner->name }}</div>
                    <div class="text-muted">{{ $team->owner->email }}</div>
                </div>
            </div>
        </div>

        <!-- Team Name -->
        <div class="">
            <x-jet-label for="name" value="{{ __('Team Name') }}" />

            <x-jet-input id="name"
                         type="text"
                         class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                         wire:model.defer="state.name"
                         :disabled="! Gate::check('update', $team)" />

            <x-jet-input-error for="name" />
        </div>
    </x-slot>

    @if (Gate::check('update', $team))
        <x-slot name="actions">
			<div class="d-flex align-items-baseline">
				<x-jet-action-message class="mr-3" on="saved">
					{{ __('Saved.') }}
				</x-jet-action-message>

				<x-jet-button>
					{{ __('Save') }}
				</x-jet-button>
			</div>
        </x-slot>
    @endif
</x-jet-form-section>