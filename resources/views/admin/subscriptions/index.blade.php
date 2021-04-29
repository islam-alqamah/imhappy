@extends('layouts.admin')

@section('title', '| Plans')

@section('content')
<div class="u-body">
    <div class="w-100 flex-container">
        <h1 class="h2 font-weight-semibold mb-4"> <i class="fa fa-align-justify"></i> {{ __('Stripe Subscriptions') }}</h1>
    </div>
    <div class="card mb-4">
            <div class="card-body">
                <table class="table table-responsive-sm table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('Reason') }}</th>
                            <th>{{ __('Team') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th class="float-right">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subscriptions as $subscription )
                        <tr>
                            <th>{{ $subscription->id }}</th>
                            <td>{{ $subscription->name }}</td>
                            <td>{{ subscription_team($subscription)->name }}</td>
                            <td>{{ $subscription->created_at->toDayDateTimeString() }}</td>
                            <td>
                                <span class="badge badge-success">{{ ucfirst($subscription->stripe_status) }}</span>
                            </td>
                            <td class="float-right">
                                <div class="btn-group" role="group" aria-label="User Actions">
                                    <a href="{{ URL::to('admin/plans/' . $subscription->id . '/edit') }}" data-toggle="tooltip" data-placement="top" title="" class="btn btn-primary mr-2" data-original-title="Edit"><i class="fa fa-edit "></i></a>
                                    <form action="{{ route('admin.plans.destroy', $subscription->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></b>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{ $subscriptions->links() }}
</div>
@endsection