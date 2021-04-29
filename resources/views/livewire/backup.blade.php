<div class="backup">
    <div class="d-flex align-items-end pb-3">
        <button wire:click="createBackup()" class="btn btn-info btn-sm ml-auto px-3">
            {{ __('Create full Backup') }}
        </button>
        <div class="dropdown ml-3">
            <button class="btn btn-info btn-sm dropdown-toggle px-3" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="0.7875rem" height="0.7875rem" viewBox="0 0 24 24"
                     fill="currentColor">
                    <path class="heroicon-ui" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
                </svg>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <button class="dropdown-item" href="#" wire:click="createBackup('only-db')">
                    {{ __('Create database backup') }}
                </button>
                <button class="dropdown-item" href="#" wire:click="createBackup('only-files')">
                    {{ __('Create files backup') }}
                </button>
            </div>
        </div>
    </div>
    {{-- <livewire:backup-health /> --}}
    <div class="card shadow-sm">
        <div class="card-header d-flex align-items-end">
            <button class="btn btn-primary btn-sm btn-refresh ml-auto" :class="{loading: loading}"
                    wire:click="updateBackupStatuses" :disabled="! activeDisk || loading">
                <svg xmlns="http://www.w3.org/2000/svg" width="0.7875rem" height="0.7875rem" viewBox="0 0 24 24"
                     fill="currentColor">
                    <path class="heroicon-ui" d="M6 18.7V21a1 1 0 0 1-2 0v-5a1 1 0 0 1 1-1h5a1 1 0 1 1 0 2H7.1A7 7 0 0 0 19 12a1 1 0 1 1 2 0 9 9 0 0 1-15 6.7zM18 5.3V3a1 1 0 0 1 2 0v5a1 1 0 0 1-1 1h-5a1 1 0 0 1 0-2h2.9A7 7 0 0 0 5 12a1 1 0 1 1-2 0 9 9 0 0 1 15-6.7z"/>
                </svg>
            </button>
        </div>
        <table class="table table-hover mb-0">
            <thead>
            <tr>
                <th scope="col">{{ __('Disk') }}</th>
                <th scope="col">{{ __('Healthy') }}</th>
                <th scope="col">{{ __('Amount of backups') }}</th>
                <th scope="col">{{ __('Newest backup') }}</th>
                <th scope="col">{{ __('Used storage') }}</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($backupStatuses as $backupStatus)
            <tr>
                <td>{{ $backupStatus['disk'] }}</td>
                <td>
                    {!! $backupStatus['healthy'] ? '<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" width="1.6rem" height="1.6rem">
                        <path d="M2.93 17.07A10 10 0 1 0 17.07 2.93 10 10 0 0 0 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM4 10l2-2 3 3 5-5 2 2-7 7-5-5z" fill="var(--success)" fill-rule="evenodd"/>
                        </svg>' : '<svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" width="1.6rem" height="1.6rem">
                        <path d="M11.41 10l2.83-2.83-1.41-1.41L10 8.59 7.17 5.76 5.76 7.17 8.59 10l-2.83 2.83 1.41 1.41L10 11.41l2.83 2.83 1.41-1.41L11.41 10zm-8.48 7.07A10 10 0 1 0 17.07 2.93 10 10 0 0 0 2.93 17.07zm1.41-1.41A8 8 0 1 0 15.66 4.34 8 8 0 0 0 4.34 15.66z" fill="var(--danger)" fill-rule="evenodd"/>
                        </svg>' 
                    !!}
                </td>
                <td>{{ $backupStatus['amount'] }}</td>
                <td>{{ $backupStatus['newest'] }}</td>
                <td>{{ $backupStatus['usedStorage'] }}</td>
            </tr>
            @empty
            <tr>
                <td class="text-center" colspan="4">
                    {{ __('No backups present') }}
                </td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{-- End component --}}
    <div class="row mt-4">
        <div class="col-12">
            {{-- Backup files --}}
            <div class="card shadow-sm">
                <div class="card-header d-flex align-items-end">
                    @if(!empty($disks))
                        @foreach ($disks as $disk)
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-secondary"
                                   class="{{ $activeDisk === $disk ? 'active' : ''  }}" @click="updateActiveDisk(disk)">
                                <input type="radio" name="options" {{ $activeDisk === $disk ? 'checked' : ''  }}">
                                {{ $disk }}
                            </label>
                        </div>  
                        @endforeach
                    @endif
    
                    <button class="btn btn-primary btn-sm btn-refresh ml-auto" wire:loading.class="loading" wire:click="getFiles()"
                            :disabled="! activeDisk || loading">
                        <svg xmlns="http://www.w3.org/2000/svg" width="0.7875rem" height="0.7875rem" viewBox="0 0 24 24"
                             fill="currentColor">
                            <path class="heroicon-ui" d="M6 18.7V21a1 1 0 0 1-2 0v-5a1 1 0 0 1 1-1h5a1 1 0 1 1 0 2H7.1A7 7 0 0 0 19 12a1 1 0 1 1 2 0 9 9 0 0 1-15 6.7zM18 5.3V3a1 1 0 0 1 2 0v5a1 1 0 0 1-1 1h-5a1 1 0 0 1 0-2h2.9A7 7 0 0 0 5 12a1 1 0 1 1-2 0 9 9 0 0 1 15-6.7z"/>
                        </svg>
                    </button>
                </div>
        
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('Path') }}</th>
                            <th scope="col">{{ __('Created at') }}</th>
                            <th scope="col">{{ __('Size') }}</th>
                            <th scope="col"/>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($backups as $backup)
                        <tr>
                            <td>{{ $backup['path'] }}</td>
                            <td>{{ $backup['date'] }}</td>
                            <td>{{ $backup['size'] }}</td>
                            <td class="text-right pr-3">
                                <a class="mr-2" href="/admin/download-backup?disk={{ $activeDisk }}&path={{ $backup['path'] }}"
                                data-toggle="tooltip" data-placement="top" data-original-title="{{ __('Download backup') }}"
                                   target="_blank" rel="noopener nofollow">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                        <path class="heroicon-ui" d="M11 14.59V3a1 1 0 0 1 2 0v11.59l3.3-3.3a1 1 0 0 1 1.4 1.42l-5 5a1 1 0 0 1-1.4 0l-5-5a1 1 0 0 1 1.4-1.42l3.3 3.3zM3 17a1 1 0 0 1 2 0v3h14v-3a1 1 0 0 1 2 0v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-3z"/>
                                    </svg>
                                </a>
                                <button class="btn btn-link" wire:click="delete('{{ $activeDisk }}', '{{ $backup['path'] }}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                        <path class="heroicon-ui" d="M8 6V4c0-1.1.9-2 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8H3a1 1 0 1 1 0-2h5zM6 8v12h12V8H6zm8-2V4h-4v2h4zm-4 4a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1z"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="4">
                                {{ __('No backups present') }}
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
        
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <h5 class="modal-title mb-3">{{ __('Delete backup') }}</h5>
                                {{-- <span class="text-muted" v-if="deletingFile"> --}}
                                <span class="text-muted">
                                    {{ __('Are you sure you want to delete the backup created at?') }}
                                </span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary cancel-button" data-dismiss="modal">
                                    {{ __('Cancel') }}
                                </button>
                                <button type="button" class="btn btn-danger delete-button" @click="deleteFile">{{ __('Delete') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End backup files --}}
        </div>
    </div>
    {{-- Confirm modal --}}
    <div class="modal fade bd-example-modal-sm" data-backdrop="false" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Confirmation') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('Are you sure to remove this backup?') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="button" wire:click="delete()" class="btn btn-danger">{{ __('Save changes') }}</button>
                </div>
            </div>
        </div>
    </div>
    </div>    