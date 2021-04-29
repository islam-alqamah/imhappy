<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div class="mb-3" x-data="{photoName: null, photoPreview: null}">
                <!-- Profile Photo File Input -->
                <input type="file" hidden
                       wire:model="photo"
                       x-ref="photo"
                       x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" class="rounded-circle" height="80px" width="80px">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <img x-bind:src="photoPreview" class="rounded-circle" width="80px" height="80px">
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
				</x-jet-secondary-button>
				
				@if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <div class="">
            <!-- Name -->
            <div class="mb-3">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" type="text" class="{{ $errors->has('name') ? 'is-invalid' : '' }}" wire:model.defer="state.name" autocomplete="name" />
                <x-jet-input-error for="name" />
            </div>

            <!-- Email -->
            <div class="mb-3">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" type="email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}" wire:model.defer="state.email" />
                <x-jet-input-error for="email" />
            </div>

            <!-- Phone -->
            <div class="mb-3">
                <x-jet-label for="mobile" value="{{ __('Phone') }}" />
                <x-jet-input id="mobile" type="text" class="{{ $errors->has('mobile') ? 'is-invalid' : '' }}" wire:model.defer="state.mobile" autocomplete="mobile" />
                <x-jet-input-error for="mobile" />
            </div>
            <!-- Gender -->
            <x-jet-label for="mobile" value="{{ __('Gender') }}" />
            <div class="row form-group mb-3">
                <div class="col-sm-12">
                  <div class="input-group input-group-md-down-break">
                    <!-- Custom Radio -->
                    <div class="form-control">
                      <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" wire:model.defer="state.gender" value="male" name="genderTypeRadio" id="genderTypeRadio1">
                        <label class="custom-control-label" for="genderTypeRadio1">{{ __('Male') }}</label>
                      </div>
                    </div>
                    <!-- End Custom Radio -->

                    <!-- Custom Radio -->
                    <div class="form-control">
                      <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" wire:model.defer="state.gender" value="female" name="genderTypeRadio" id="genderTypeRadio2" checked="">
                        <label class="custom-control-label" for="genderTypeRadio2">{{ __('Female') }}</label>
                      </div>
                    </div>
                    <!-- End Custom Radio -->

                    <!-- Custom Radio -->
                    <div class="form-control">
                      <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" wire:model.defer="state.gender" value="other" name="genderTypeRadio" id="genderTypeRadio3">
                        <label class="custom-control-label" for="genderTypeRadio3">{{ __('Other') }}</label>
                      </div>
                    </div>
                    <!-- End Custom Radio -->
                  </div>
                </div>
              </div>
        </div>
    </x-slot>

    <x-slot name="actions">
		<div class="d-flex align-items-baseline">
			<x-jet-action-message class="mr-3" on="saved">
				{{ __('Profile saved.') }}
			</x-jet-action-message>

			<x-jet-button>
				{{ __('Save') }}
			</x-jet-button>
		</div>
    </x-slot>
</x-jet-form-section>