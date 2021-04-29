<x-account-layout>
    <x-slot name="header">
        <div class="d-none d-lg-block">
            <h1 class="h2 text-white">{{ __('Subscription')  }}</h1>
        </div>
    </x-slot>

<div class="card">
    <div class="card-header">{{ __('Subscription') }}</div>

    <div class="card-body">
        @if(currentTeam()->subscribed())
        @if($subscription)
        <ul>
            <li>
                {{ __('plan') }} : {{ currentTeam()->plan->title }} ({{$subscription->amount()}} / {{$subscription->interval() }})

                @if(currentTeam()->subscription('default')->cancelled())
                {{ __('Ends') }} {{$subscription->cancelAt()}}. <a href=" {{ route('account.subscriptions.resume') }} "> Resume </a>
                @endif
            </li>
            @if($coupon = $subscription->coupon())
            <li>
                {{ __('Coupon') }} : {{$coupon->name()}} ( {{$coupon->value()}} OFF )
            </li>
            @endif
            @endif

            @if($invoice)
            <li>
                {{ __('Next Payment') }} : {{$invoice->amount()}} in {{$invoice->nextPaymentAttempt()}}
            </li>
            @endif
            @if($customer)
            <li>
                {{ __('Balance') }} : {{$customer->balance()}}
            </li>
            @endif
        </ul>

        @else
        <p> {{ __('You don\'t have a subscription') }}</p>
        @endif

        <div>
            <a href="{{currentTeam()->billingPortalUrl(route('account.subscriptions'))}}"> Biling portal</a>
        </div>
    </div>
</div>
</x-account-layout>
