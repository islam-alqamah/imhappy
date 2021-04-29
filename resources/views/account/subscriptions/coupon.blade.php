<x-account-layout>
    <x-slot name="header">
        <div class="d-none d-lg-block">
            <h1 class="h2 text-white">{{ __('Coupon')  }}</h1>
        </div>
    </x-slot>
<div class="card">
    <div class="card-header">{{ __('Coupon') }}</div>

    <div class="card-body">
        <form action="{{ route('account.subscriptions.coupon') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="coupon">{{ __('Coupon') }}</label>
                <input type="text" name="coupon" id="coupon" class="form-control @error('coupon') is-invalid @enderror">
                @error('coupon')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message }}</strong>
                </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Apply Coupon') }}</button>
        </form>
    </div>

</div>
</x-account-layout>