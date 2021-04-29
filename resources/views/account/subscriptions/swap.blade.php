<x-account-layout>
    <x-slot name="header">
        <div class="d-none d-lg-block">
            <h1 class="h2 text-white">{{ __('Swap Plan') }}
            </h1>
        </div>
    </x-slot>

    <div class="card mb-3 mb-lg-5">
        <!-- Header -->
        <div class="card-header">
            <h5 class="card-header-title">{{ __('Our plans') }}</h5>
        </div>
        <!-- End Header -->

        <!-- Body -->
        <div class="card-body">
            <div class="row">
                <!-- Pricing Section -->
                <livewire:swap-plan />
            </div>
</x-account-layout>
