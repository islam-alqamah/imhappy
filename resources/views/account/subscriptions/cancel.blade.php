<x-account-layout>
    <x-slot name="header">
        <div class="d-none d-lg-block">
            <h1 class="h2 text-white">{{ __('Cancel')  }}</h1>
        </div>
    </x-slot>

<div class="card">
    <div class="card-header">{{ __('Cancel') }}</div>

    <div class="card-body">
        <form action="{{ route('account.subscriptions.cancel') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary " id="card-button"> {{ __('Cancel') }} </button>

        </form>
    </div>
</div>

</x-account-layout>
