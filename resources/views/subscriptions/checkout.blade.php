<x-account-layout>
    <x-slot name="header">
        <div class="d-none d-lg-block">
            <h1 class="h2 text-white">{{ __('Checkout')  }}</h1>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-header">{{ __('Payments methodes') }}</div>
        
        <div class="card-body">

                <x:card-form :action="route('subscriptions.store')">
                    <input type="hidden" name="plan" value="{{ request('plan') }}"/>
                    <div class="text-center">

                    <div class="form-group">
                        <label for="coupon">{{ __('Coupon') }}</label>
                        <input type="text" name="coupan" id="coupon" class="form-control">
                    </div>
                    
                    <button type="submit" class="btn btn-primary " id="card-button" data-secret="{{ $intent['client_secret'] }}"> {{ __('Subscribe') }} </button>
                </x:card-form>

        </div>

    </div>
    @push('styles')
{{--    <script src="https://js.stripe.com/v3/"></script>--}}
    @endpush
</x-account-layout>
