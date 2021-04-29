@extends('layouts.admin')

@section('title', '| Plans')

@section('content')
<div class="u-body">
    <div class="w-100 flex-container">
        <h1 class="h2 font-weight-semibold mb-4"> <i class="fa fa-align-justify"></i> {{ __('Create new plan') }}</h1>
    </div>
    <div class="card">
        <div class="card-header">
            <strong>{{ __('Create a Plan') }}</strong> 
        </div>
        <div class="card-body">
            <form action="{{ route('admin.plans.store') }}" method="POST" class="form-horizontal offset-sm-2">
                    {!! csrf_field() !!}
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="hf-name">{{ __('Plan name') }}</label>
                    <div class="col-md-6">
                        <input type="text" id="name" name="name" class="form-control"
                            placeholder="{{ __('Enter Plan name..') }}"
                            value="{{ old('name') }}">

                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="hf-name">{{ __('Plan Monthly Price') }}</label>
                    <div class="col-md-6">
                        <input type="text" id="price" name="price" class="form-control"
                            placeholder="Enter Plan Monthly Price.."
                            value="{{ old('price') }}">

                            @if ($errors->has('price'))
                                <span class="text-danger">{{ $errors->first('price') }}</span>
                            @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="hf-name">{{ __('Plan Annual Price') }}</label>
                    <div class="col-md-6">
                        <input type="text" id="annual_price" name="annual_price" class="form-control"
                               placeholder="Enter Plan Annual Price.."
                               value="{{ old('annual_price') }}">

                        @if ($errors->has('annual_price'))
                            <span class="text-danger">{{ $errors->first('annual_price') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="hf-name">{{ __('Plan Trial') }}</label>
                    <div class="col-md-6">
                        <input type="text" id="trial" name="trial" class="form-control"
                            placeholder="Enter Plan number of days .."
                            value="{{ old('trial') }}">

                            @if ($errors->has('trial'))
                                <span class="text-danger">{{ $errors->first('trial') }}</span>
                            @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="branches">Branches Limit</label>
                    <div class="col-md-6">
                        <input type="text" id="branches" name="branches" class="form-control"
                               value="">

                        @if ($errors->has('branches'))
                            <span class="text-danger">{{ $errors->first('branches') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="points">Points Limit</label>
                    <div class="col-md-6">
                        <input type="text" id="points" name="points" class="form-control"
                               value="">

                        @if ($errors->has('points'))
                            <span class="text-danger">{{ $errors->first('points') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="channels">Channels</label>
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
                <button type="submit" class="btn btn-secondary"><i class="fa fa-dot-circle-o"></i> {{ __('Create plan') }}</button>
                <button type="reset" class="btn btn-danger"><i class="fa fa-ban"></i> Reset</button>
            </form>
        </div>
    </div>
</div>
@endsection