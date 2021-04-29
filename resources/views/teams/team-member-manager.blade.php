<div>
    @if (Gate::check('addTeamMember', $team))
        <x-jet-section-border />

        <!-- Add Team Member -->
        <div class="mt-10 mt-sm-0">
            <x-jet-form-section submit="addTeamMember">
                <x-slot name="title">
                    {{ __('Add Team Member') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Add a new team member to your team, allowing them to collaborate with you.') }}
                </x-slot>

                <x-slot name="form">
                    <div class="mb-3">
                        {{ __('Please provide the email address of the person you would like to add to this team. The email address must be associated with an existing account.') }}
                    </div>

                    <!-- Member Email -->
                    <div class="mb-2">
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="name" type="email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                                     wire:model.defer="addTeamMemberForm.email" />
                        <x-jet-input-error for="email" />
                    </div>

                    <!-- Role -->
                    @if (count($this->roles) > 0)
                        <div class="mb-3">
                            <x-jet-label for="role" value="{{ __('Role') }}" />

                            <input type="hidden" class="{{ $errors->has('role') ? 'is-invalid' : '' }}">
                            <x-jet-input-error for="role" />

                            <div class="list-group">
                                @foreach ($this->roles as $index => $role)
                                    <a href="#" class="list-group-item list-group-item-action{{ isset($addTeamMemberForm['role']) && $addTeamMemberForm['role'] !== $role->key ? ' text-black-50' : '' }}"
                                       wire:click.prevent="$set('addTeamMemberForm.role', '{{ $role->key }}')">
                                        <div>
                                        <span class="{{ $addTeamMemberForm['role'] == $role->key ? 'font-weight-bold' : '' }}">
                                            {{ $role->name }}
                                        </span>
                                            @if ($addTeamMemberForm['role'] == $role->key)
                                                <svg class="ml-1 text-success font-weight-light" width="20" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            @endif
                                        </div>

                                        <!-- Role Description -->
                                        <div class="mt-2">
                                            {{ $role->description }}
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </x-slot>

                <x-slot name="actions">
                    <x-jet-action-message class="mr-3" on="saved">
                        {{ __('Added.') }}
                    </x-jet-action-message>

                    <x-jet-button>
                        {{ __('Add') }}
                    </x-jet-button>
                </x-slot>
            </x-jet-form-section>
        </div>
    @endif

    @if ($team->teamInvitations->isNotEmpty() && Gate::check('addTeamMember', $team))
        <x-jet-section-border />

        <!-- Team Member Invitations -->
        <div class="mt-10 sm:mt-0">
            <x-jet-action-section>
                <x-slot name="title">
                    {{ __('Pending Team Invitations') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('These people have been invited to your team and have been sent an invitation email. They may join the team by accepting the email invitation.') }}
                </x-slot>

                <x-slot name="content">
                    <div class="space-y-6">
                        @foreach ($team->teamInvitations as $invitation)
                            <div class="flex items-center justify-between">
                                <div class="text-gray-600">{{ $invitation->email }}</div>

                                <div class="flex items-center">
                                    @if (Gate::check('removeTeamMember', $team))
                                        <!-- Cancel Team Invitation -->
                                        <button class="cursor-pointer ml-6 text-sm text-red-500 focus:outline-none"
                                                            wire:click="cancelTeamInvitation({{ $invitation->id }})">
                                            {{ __('Cancel') }}
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-slot>
            </x-jet-action-section>
        </div>
    @endif

    @if ($team->users->isNotEmpty())
        <x-jet-section-border />

        <!-- Manage Team Members -->
        <x-jet-action-section>
            <x-slot name="title">
                {{ __('Team Members') }}
            </x-slot>

            <x-slot name="description">
                {{ __('All of the people that are part of this team.') }}
            </x-slot>

            <!-- Team Member List -->
            <x-slot name="content">
                @foreach ($team->users->sortBy('name') as $user)
                    <div class="d-flex justify-content-between mb-3">
                        <div class="d-flex justify-content-start">
                            <div class="pr-3">
                                <img width="32" class="rounded-circle" src="{{ $user->profile_photo_url }}">
                            </div>
                            <span>{{ $user->name }}</span>
                        </div>

                        <div class="d-flex">
                            <!-- Manage Team Member Role -->
                            @if (Gate::check('addTeamMember', $team) && Laravel\Jetstream\Jetstream::hasRoles())
                                <button class="btn btn-link text-secondary" wire:click="$emit('manageRole', {{ $user->id }})">
                                    {{ Laravel\Jetstream\Jetstream::findRole($user->membership->role)->name }}
                                </button>
                            @elseif (Laravel\Jetstream\Jetstream::hasRoles())
                                <button class="btn btn-link text-secondary disabled text-decoration-none ml-2">
                                    {{ Laravel\Jetstream\Jetstream::findRole($user->membership->role)->name }}
                                </button>
                            @endif

                        <!-- Leave Team -->
                            @if ($this->user->id === $user->id)
                                <button class="btn btn-link text-danger text-decoration-none" wire:click="$emit('confirmingLeavingTeam')">
                                    {{ __('Leave') }}
                                </button>

                                <!-- Remove Team Member -->
                            @elseif (Gate::check('removeTeamMember', $team))
                                <button class="btn btn-link text-danger text-decoration-none" wire:click="$emit('confirmTeamMemberRemoval', {{ $user->id }})">
                                    {{ __('Remove') }}
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </x-slot>
    </x-jet-action-section>
    @endif

<!-- Role Management Modal -->
    <x-jet-dialog-modal id="currentlyManagingRoleModal">
        <x-slot name="title">
            {{ __('Manage Role') }}
        </x-slot>

        <x-slot name="content">
            <div class="list-group">
                @foreach ($this->roles as $index => $role)
                    <a href="#" class="list-group-item list-group-item-action{{ $currentRole !== $role->key ? ' text-black-50' : '' }}"
                       wire:click.prevent="$set('currentRole', '{{ $role->key }}')">
                        <div>
                            <span class="{{ $currentRole == $role->key ? 'font-weight-bold' : '' }}">
                                {{ $role->name }}
                            </span>
                            @if ($currentRole == $role->key)
                                <svg class="ml-1 text-success font-weight-light" width="20" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            @endif
                        </div>

                        <!-- Role Description -->
                        <div class="mt-2">
                            {{ $role->description }}
                        </div>
                    </a>
                @endforeach
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="stopManagingRole" wire:loading.attr="disabled"
                                    data-dismiss="modal">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="updateRole" wire:loading.attr="disabled"
                          data-dismiss="modal">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Leave Team Confirmation Modal -->
    <x-jet-confirmation-modal id="confirmingLeavingTeamModal">
        <x-slot name="title">
            {{ __('Leave Team') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you would like to leave this team?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingLeavingTeam')" wire:loading.attr="disabled"
                                    data-dismiss="modal">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="leaveTeam" wire:loading.attr="disabled"
                                 data-dismiss="modal">
                {{ __('Leave') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>

    <!-- Remove Team Member Confirmation Modal -->
    <x-jet-confirmation-modal id="confirmingTeamMemberRemovalModal">
        <x-slot name="title">
            {{ __('Remove Team Member') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you would like to remove this person from the team?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingTeamMemberRemoval')" wire:loading.attr="disabled"
                                    data-dismiss="modal">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="removeTeamMember" wire:loading.attr="disabled"
                                 data-dismiss="modal">
                {{ __('Remove') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>

    @push('scripts')
        <script>
            Livewire.on('manageRole', id => {
                @this.manageRole(id)
                new Bootstrap.Modal(document.getElementById('currentlyManagingRoleModal')).toggle()
            })

            Livewire.on('confirmingLeavingTeam', id => {
                @this.confirmingLeavingTeam = true
                new Bootstrap.Modal(document.getElementById('confirmingLeavingTeamModal')).toggle()
            })

            Livewire.on('confirmTeamMemberRemoval', id => {
                @this.confirmTeamMemberRemoval(id)
                new Bootstrap.Modal(document.getElementById('confirmingTeamMemberRemovalModal')).toggle()
            })
        </script>
    @endpush
</div>