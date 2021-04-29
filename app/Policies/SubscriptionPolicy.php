<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Laravel\Cashier\Subscription;

class SubscriptionPolicy
{
    use HandlesAuthorization;

    public function cancel(Subscription $subscription, User $user)
    {
        //    return !$subscription->cancelled();
        return $user->ownsTeam(currentTeam());
    }

    public function resume(User $user, Subscription $subscription)
    {
        return $subscription->cancelled();
    }
}
