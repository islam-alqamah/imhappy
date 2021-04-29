<div class="u-body">
    <div class="flex-container">
        <h1 class="h2 font-weight-semibold mb-4">{{ __('Maintenance mode') }}</h1>
        <div class="form-group mt-1 ml-4">
            <label class="d-flex align-items-center justify-content-between">

                <div class="form-toggle">
                    <input wire:model='maintenance' name="toggleCheckbox" type="checkbox" checked="" disabled>

                    <div class="form-toggle__item">
                        <i class="fa" data-check-icon="" data-uncheck-icon=""></i>
                    </div>
                </div>
            </label>
        </div>

    </div>
    <div class="card">
        <div class="card-body">
            @if (app()->isDownForMaintenance())
            <div class="mb-6 text-center">
                <svg class="w-16 h-16 fill-current text-danger mb-4" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 640 512">
                    <path
                        d="M320 32C196.3 32 96 132.3 96 256c0 123.76 100.3 224 224 224s224-100.24 224-224c0-123.7-100.3-224-224-224zm0 400c-97.05 0-176-78.95-176-176S222.95 80 320 80s176 78.95 176 176-78.95 176-176 176zm0-112c-17.67 0-32 14.33-32 32s14.33 32 32 32 32-14.33 32-32-14.33-32-32-32zm22.32-192h-44.64c-9.47 0-16.86 8.17-15.92 17.59l12.8 128c.82 8.18 7.7 14.41 15.92 14.41h19.04c8.22 0 15.1-6.23 15.92-14.41l12.8-128c.94-9.42-6.45-17.59-15.92-17.59zM48 256c0-59.53 19.55-117.38 55.36-164.51 5.18-6.81 4.48-16.31-2.03-21.86l-12.2-10.41c-6.91-5.9-17.62-5.06-23.15 2.15C23.32 117.02 0 185.5 0 256c0 70.47 23.32 138.96 65.96 194.62 5.53 7.21 16.23 8.05 23.15 2.16l12.19-10.4c6.51-5.55 7.21-15.04 2.04-21.86C67.55 373.37 48 315.53 48 256zM572.73 59.71c-5.58-7.18-16.29-7.95-23.17-2l-12.15 10.51c-6.47 5.6-7.1 15.09-1.88 21.87C572.04 137.47 592 195.81 592 256c0 60.23-19.96 118.57-56.46 165.95-5.22 6.78-4.59 16.27 1.88 21.87l12.15 10.5c6.87 5.95 17.59 5.18 23.17-2C616.21 396.38 640 327.31 640 256c0-71.27-23.79-140.34-67.27-196.29z" />
                </svg>

                <p>{{ __('You are currently in Maintenance Mode') }}</p>
                <div class="mb-3 mt-2">
                    <a href="{{ url($token) }}" target="__blank">{{ url($token) }}</a>
                </div>
                <button type="submit" wire:loading.remove wire:click="up" class="btn btn-xs btn-success mt-2">
                    <span wire:loading.remove><i class="fas fa-check-circle"></i> {{ __('Activate live mode') }}</span>
                    <span wire:loading>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Processing...
                    </span>
                </button>
            </div>
            @else
            <h2>{{ __('Put application on maintenance mode') }}</h2><br>
            <form wire:submit.prevent="down('{{ $token }}')">
                <div class="form-group mb-4">
                    <label for="successTextInput">Token</label>
                    <input id="successTextInput" wire:model='token' class="form-control" type="text" required
                        placeholder="Placeholder" aria-describedby="successTextInput">
                        <p><small>{{ __('A link will be generate with this token to let you be able to access application even maintenance mode active.') }}</small></p>
                        <button type="button" wire:click='generateToken' class="btn btn-soft-primary btn-xs mt-2"> <i class="fas fa-redo"></i> {{ __('Generate new token') }}</button>
                </div>
    
                <button type="submit" wire:loading.remove class="btn btn-xs btn-danger">
                    <span wire:loading.remove><i class="fas fa-times-circle"></i> {{ __('Activate maintenance mode') }}</span>
                    <span wire:loading>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        {{ __('Assign Permissions') }}...
                    </span>
                </button>
            </form>
            @endif
        </div>
        </div>
        <div class="mb-2">

        </div>
    </div>
@push('styles')
<style>
    .form-toggle input[type="checkbox"]:checked+.form-toggle__item,
    .form-toggle input[type="checkbox"]:checked+* .form-toggle__item,
    .form-toggle input[type="radio"]:checked+.form-toggle__item,
    .form-toggle input[type="radio"]:checked+* .form-toggle__item {
        background-color: #0dd157;
        border-color: #0dd157;
    }

    svg {
        width: 80px;
        height: 80px;
        fill: red;
    }

    .form-toggle__item {
        width: 53px;
        height: 24px;
    }

    /* svg:hover {
        fill: red;
        } */

</style>
@endpush
