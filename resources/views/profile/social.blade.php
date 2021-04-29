<x-account-layout>
    <x-slot name="header">
        <div class="d-none d-lg-block">
            <h1 class="h2 text-white">{{ __('Connected account') }}</h1>
        </div>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            @if (JoelButcher\Socialstream\Socialstream::show())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.connected-accounts-form')
                </div>
            @endif
        </div>
    </div>
    @push('styles')
        <style>
            .flex svg{
                width: 40px;
            }
            .flex{
                display:flex;
                flex-wrap: wrap;
                justify-content:space-between;
            }
            .justify-between{
                padding-top:25px;
            }
        </style>
    @endpush
</x-account-layout>
