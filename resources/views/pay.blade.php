
<x-account-layout>
    <x-slot name="header">
        <div class="d-none d-lg-block">
            <h1 class="h2 text-white">{{ __('Pay link') }} 
            </h1>
        </div>
    </x-slot>

<div class="card mb-3 mb-lg-5">
    {{-- <x-paddle-button :url="$payLink" class="">
        Buy This product.
    </x-paddle-button> --}}
    <a href="#!" class="paddle_button btn btn-success" data-override="{{ $team->newSubscription('default', $monthly = 633408)
        ->returnTo(route('account.overview'))
        ->create() }}">
        Subscribe
    </a>
</div>
</x-account-layout>