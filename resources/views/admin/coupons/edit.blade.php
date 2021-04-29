@extends('layouts.admin')

@section('title', '| Edit coupons')
@section('content')
<div class="u-body">
    <h1 class="h2 font-weight-semibold mb-4"> <i class="fa fa-align-justify"></i> {{ __('Coupons / Discount') }}</h1>
    <div class="card">
        <div class="card-header">
            <strong>{{ __('Update Coupon') }}</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST" class="form-horizontal offset-sm-2">
                    {!! csrf_field() !!}
                    @method('PUT')
                    <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="hf-name">{{ __('Coupon name') }}</label>
                            <div class="col-md-6">
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Coupon name.."
                                    value="{{ $coupon->name }}" required>
        
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="hf-name">{{ __('Coupon Code') }}</label>
                                <div class="col-md-6">
                                    <input type="text" id="code_id" name="gateway_id" class="form-control"
                                        placeholder="Exp: 25OFF"
                                        value="{{ $coupon->gateway_id }}" required>
            
                                        @if ($errors->has('gateway_id'))
                                            <span class="text-danger">{{ $errors->first('gateway_id') }}</span>
                                        @endif
                                </div>
                            </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="hf-name">{{ __('Percentage Off') }}</label>
                            <div class="col-md-6">
                                <input type="text" id="price" name="percent_off" class="form-control"
                                    placeholder="Enter Plan price.."
                                    value="{{ $coupon->percent_off }}" required>
        
                                    @if ($errors->has('percent_off'))
                                        <span class="text-danger">{{ $errors->first('percent_off') }}</span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="hf-name">{{ __('Duration') }}</label>
                            <div class="col-md-6">
                                    <select id="duration" type="" class="form-control" name="duration" required>
                                        <option value="">{{ __('Select Duration') }}</option>
                                        <option value="once" {{ $coupon->duration == 'once' ? 'selected' : '' }}>{{ __('Once') }}</option>
                                        <option value="repeating" {{ $coupon->duration == 'repeating' ? 'selected' : '' }}>{{ __('Repeating') }}</option>
                                        <option value="forever" {{ $coupon->duration == 'forever' ? 'selected' : '' }}>{{ __('Forever') }}</option>
                                    </select>
        
                                    @if ($errors->has('duration'))
                                        <span class="text-danger">{{ $errors->first('duration') }}</span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="hf-name">{{ __('Duration in months') }}</label>
                            <div class="col-md-6">
                                <input type="text" id="duration_in_months" name="duration_in_months" class="form-control"
                                    placeholder="Duration in month"
                                    value="{{ $coupon->duration_in_months }}">
                                    <span class="text-danger" style="font-size:11px;"><i class="fa fa-question-circle"></i> 
                                        {{ __('Required only if duration is repeating, in which case it must be a positive integer that specifies the number of months the discount will be in effect.') }}</span>
                                    @if ($errors->has('duration_in_months'))
                                        <span class="text-danger">{{ $errors->first('duration_in_months') }}</span>
                                    @endif
                            </div>
                        </div>
                        <hr>
                    <button type="submit" class="btn btn-success"><i class="fa fa-dot-circle-o"></i> {{ __('Create') }}</button>
                    <button type="reset" class="btn btn-danger"><i class="fa fa-ban"></i> {{ __('Reset') }}</button>
                </form>
        </div>
    </div>
</div>
@endsection