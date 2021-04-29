@extends('layouts.admin')

@section('title', '| Plans')

@section('content')
<div class="u-body">
    <div class="w-100 flex-container">
        <h1 class="h2 font-weight-semibold mb-4"> <i class="fa fa-align-justify"></i> {{ __('Plans') }}</h1>
        <a href="{{ route('admin.plans.create') }}" class="btn btn-secondary mb-3">{{ __('New plan') }}</a>
    </div>
    <div class="card mb-4">
            <div class="card-body">
                <table class="table table-responsive-sm table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Annual Price') }}</th>
                            <th>{{ __('Branches Limit') }}</th>
                            <th>{{ __('Points Limit') }}</th>
                            <th>{{ __('Channels') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th class="float-right">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plans as $plan )
                        <tr>
                            <td>{{ $plan->title }}</td>
                            <td>{{ $plan->price }}</td>
                            <td>{{ $plan->annual_price }}</td>
                            <td>{{ $plan->branches }}</td>
                            <td>{{ $plan->points }}</td>
                            <td>{{ $plan->channels }}</td>
                            <td>
                                @if ($plan->active === 1)
                                <span class="badge badge-success"> {{ __('Active') }}</span>
                                @else
                                <span class="badge badge-danger"> {{ __('Inactive') }}</span>
                                @endif
                            </td>
                            <td class="float-right">
                                <div class="btn-group" role="group" aria-label="User Actions">
                                    <a href="{{ URL::to('admin/plans/' . $plan->id . '/edit') }}" data-toggle="tooltip" data-placement="top" title="" class="btn btn-primary mr-2" data-original-title="Edit"><i class="fa fa-edit "></i></a>
                                    <form action="{{ route('admin.plans.destroy', $plan->id)}}" method="post">
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
</div>
@endsection