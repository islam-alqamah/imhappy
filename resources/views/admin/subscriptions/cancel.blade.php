@extends('layouts.admin')

@section('title', '| Plans')

@section('content')
<div class="u-body">
    <div class="w-100 flex-container">
        <h1 class="mb-4 h2 font-weight-semibold"> <i class="fa fa-align-justify"></i> {{ __('Subscriptions cancel') }}</h1>
    </div>
    <div class="mb-4 card">
            <div class="card-body">
                <table class="table table-responsive-sm table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('ID') }}</th>
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
                            <td>{{ $subscription->reason }}</td>
                            <td>{{ $subscription->team->name }}</td>
                            <td>{{ $subscription->created_at->toDayDateTimeString() }}</td>
                            <td>
                                <span class="badge badge-danger">{{ __('Cancel') }}</span>
                            </td>
                            <td class="float-right">
                                <div class="btn-group" role="group" aria-label="User Actions">
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