@extends('layouts.admin')

@section('title', '| Plans')

@section('content')
<div class="u-body">
    <div class="card">
        <div class="card-header">
            <strong>{{ __('Update Plan') }}</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.plans.update', $plan->id) }}" method="POST" class="form-horizontal offset-sm-2">
                    {!! csrf_field() !!}
                    @method('PUT')
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="hf-name">{{__('Plan name')}}</label>
                    <div class="col-md-6">
                        <input type="text" id="name" name="name" class="form-control" value="{{ $plan->title }}"
                            placeholder="Enter Plan name..">

                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="hf-name">{{ __('Monthly Price') }}</label>
                    <div class="col-md-6">
                        <input type="text" id="price" name="price" class="form-control"
                            value="{{ $plan->price }}">

                            @if ($errors->has('price'))
                                <span class="text-danger">{{ $errors->first('price') }}</span>
                            @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="hf-name">{{ __('Annual Price') }}</label>
                    <div class="col-md-6">
                        <input type="text" id="annual_price" name="annual_price" class="form-control"
                               value="{{ $plan->annual_price }}">

                        @if ($errors->has('annual_price'))
                            <span class="text-danger">{{ $errors->first('annual_price') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="hf-name">{{__('Plan Trial')}}</label>
                    <div class="col-md-6">
                        <input type="text" id="trial" name="trial" class="form-control"
                            value="{{ $plan->trial_period_days }}">

                            @if ($errors->has('trial'))
                                <span class="text-danger">{{ $errors->first('trial') }}</span>
                            @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="branches">{{__('Branches Limit')}}</label>
                    <div class="col-md-6">
                        <input type="text" id="branches" name="branches" class="form-control"
                               value="{{ $plan->branches }}">

                        @if ($errors->has('branches'))
                            <span class="text-danger">{{ $errors->first('branches') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="points">{{__('Points Limit')}}</label>
                    <div class="col-md-6">
                        <input type="text" id="points" name="points" class="form-control"
                               value="{{ $plan->points }}">

                        @if ($errors->has('points'))
                            <span class="text-danger">{{ $errors->first('points') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="channels">{{__('Channels')}}</label>
                    <div class="col-md-6">
                        <label> QR-Code
                            <input type="checkbox" name="channels[]" class="form-control"
                                   value="QR-Code">
                        </label>
                        <label> Touchless
                            <input type="checkbox" name="channels[]" class="form-control"
                                   value="Touchless">
                        </label>
                    </div>
                </div>

                <hr>
                <button type="submit" class="btn btn-secondary"><i class="fa fa-dot-circle-o"></i> {{ __('Edit plan') }}</button>
                <button type="reset" class="btn btn-danger"><i class="fa fa-ban"></i> {{ __('Reset') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection