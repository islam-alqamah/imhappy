<x-guest-layout>
    <div class="padding-top-40">
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>


        <x-jet-validation-errors class="mb-3 rounded-0" />

        @if (session('status'))
            <div class="mb-3 alert alert-success rounded-0" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <x-jet-label value="{{ __('Email') }}" />

                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                 name="email" :value="old('email')" required />
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('Password') }}" />

                    <x-jet-input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                                 name="password" required autocomplete="current-password" />
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        @if (Route::has('password.request'))
                            <a class="mr-3 text-muted" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-jet-button>
                            {{ __('Login') }}
                        </x-jet-button>
                    </div>
                </div>
            </form>
        </div>
        @if (JoelButcher\Socialstream\Socialstream::show())
            {{-- <x-socialstream-providers /> --}}
        @endif
    </x-jet-authentication-card>
    </div>
    @push('styles')
    <style>
        svg{
            width: 40px;
        }
        .flex{
            display:flex;
            flex-wrap: wrap;
            margin-left:auto;
            margin-right:auto;
            padding-bottom:15px;
        }
    </style>
@endpush
</x-guest-layout>