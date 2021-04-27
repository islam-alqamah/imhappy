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
            <span class="center"> {{ __('Plan will automaticaly create on the fly to the stripe dashboard') }} </span>
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
                    <label class="col-md-3 col-form-label" for="hf-name">{{ __('Plan Price') }}</label>
                    <div class="col-md-6">
                        <input type="text" id="price" name="price" class="form-control"
                            placeholder="Enter Plan price.."
                            value="{{ old('name') }}">

                            @if ($errors->has('price'))
                                <span class="text-danger">{{ $errors->first('price') }}</span>
                            @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="hf-name">{{ __('Plan Trial') }}</label>
                    <div class="col-md-6">
                        <input type="text" id="trial" name="trial" class="form-control"
                            placeholder="Enter Plan name.."
                            value="{{ old('trial') }}">

                            @if ($errors->has('trial'))
                                <span class="text-danger">{{ $errors->first('trial') }}</span>
                            @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="hf-name">{{ __('Plan interval') }}</label>
                    <div class="col-md-6">
                            <select id="interval" type="" class="form-control" name="interval">
                                <option value="">{{ __('Select Interval') }}</option>
                                <option value="day">{{ __('Daily') }}</option>
                                <option value="week">{{ __('Weekly') }}</option>
                                <option value="month">{{ __('Monthly') }}</option>
                                <option value="year">{{ __('Yearly') }}</option>
                            </select>

                            @if ($errors->has('interval'))
                                <span class="text-danger">{{ $errors->first('interval') }}</span>
                            @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="hf-name">{{ __('Max team member') }}</label>
                    <div class="col-md-9">
                        <input type="number" id="teams_limit" name="teams_limit" class="form-control"
                        placeholder="Number of member allow for this Plan"
                        value="{{ old('teams_limit') }}">
                        @if ($errors->has('teams_limit'))
                            <span class="text-danger">{{ $errors->first('teams_limit') }}</span>
                        @endif
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