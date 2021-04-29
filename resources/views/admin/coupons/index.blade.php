@extends('layouts.admin')

@section('title', '| Coupons')

@section('content')
<div class="u-body">
    <div class="w-100 flex-container">
        <h1 class="h2 font-weight-semibold mb-4"> <i class="fa fa-align-justify"></i> {{ __('Coupons') }}</h1>
        <a href="{{ route('admin.coupons.create') }}" class="btn btn-secondary mb-3">{{ __('New coupon') }}</a>
    </div>
        <div class="card mb-4">
            <div class="card-body">
                <table class="table table-responsive-sm table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Percent off') }}</th>
                            <th>{{ __('Coupon Code') }}</th>
                            <th>{{ __('Duration') }}</th>
                            <th>{{ __('Date') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $coupon )
                        <tr>
                            <td>{{ $coupon->name }}</td>
                            <td><span class="badge badge-info" style="font-size:15px">{{ $coupon->percent_off }} %</span> </td>
                            <td><span class="badge badge-success" style="font-size:15px">{{ $coupon->gateway_id }}</span> </td>
                            <td>{{ $coupon->duration }}</td>
                            <td>{{ $coupon->created_at->diffForHumans() }}</td>
                            <td class="float-right">
                                <div class="btn-group" role="group" aria-label="User Actions">
                                    <a href="{{ URL::to('admin/coupons/' . $coupon->id . '/edit') }}" data-toggle="tooltip" data-placement="top" title="" class="btn btn-primary mr-2" data-original-title="Edit"><i class="fa fa-edit "></i></a>
                                    <form action="{{ route('admin.coupons.destroy', $coupon->id)}}" method="post">
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