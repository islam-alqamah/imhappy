@extends('layouts.admin')

@section('title', '| Edit User')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit User') }}: {{$user->name}}</div>

                <div class="card-body">
                    {{ Form::model($user, array('route' => array('admin.users.update', $user->id), 'method' => 'PUT')) }}{{-- Form model binding to automatically populate our fields with user data --}}

                    <div class="form-group">
                        {{ Form::label('name', 'Name') }}
                        {{ Form::text('name', null, array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('email', 'Email') }}
                        {{ Form::email('email', null, array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                        <label class="control-label mb-5" for="city">
                            {{ __('Subscribe to Plan') }}
                        </label>
                        <select class="form-control select2" name="plan_id" >
                            <option value="0">{{ __('Trial') }}</option>
                            @foreach($plans as $plan)
                                <option value="{{ $plan->id }}">{{ $plan->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <h5><b>{{ __('Give Role') }}</b></h5>

                    <div class='form-group'>
                        @foreach ($roles as $role)
                            {{ Form::checkbox('roles[]',  $role->id, $user->roles ) }}
                            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

                        @endforeach
                    </div>

                    <div class="form-group">
                        <label class="control-label mb-5" >
                            {{ __('Permissions') }}
                        </label>
                        <select class="form-control select2" multiple name="permissions[]" >

                            <option
                                    @if(in_array('all',json_decode($user->user_permissions))) selected @endif
                            value="all">{{ __('all') }}</option>

                            <option
                                    @if(in_array('dashboard',json_decode($user->user_permissions))) selected @endif
                            value="dashboard">{{ __('Dashboard') }}</option>

                            <option
                                    @if(in_array('charts',json_decode($user->user_permissions))) selected @endif
                            value="charts">{{ __('Charts & Analytics') }}</option>

                            <option
                                    @if(in_array('reports',json_decode($user->user_permissions))) selected @endif
                            value="reports">{{ __('Reports') }}</option>

                            <option
                                    @if(in_array('branches',json_decode($user->user_permissions))) selected @endif
                            value="branches">{{ __('Branches') }}</option>

                            <option
                                    @if(in_array('points',json_decode($user->user_permissions))) selected @endif
                            value="points">{{ __('Points') }}</option>
                            <optgroup label="{{ __('Account') }}">
                                <option
                                        @if(in_array('account-settings',json_decode($user->user_permissions))) selected @endif
                                value="account-settings">{{ __('Settings') }}</option>

                                <option
                                        @if(in_array('account-payments',json_decode($user->user_permissions))) selected @endif
                                value="account-payments">{{ __('Payments') }}</option>
                            </optgroup>
                            <optgroup label="{{__('Admin')}}">
                                <option
                                        @if(in_array('admin-users',json_decode($user->user_permissions))) selected @endif
                                value="admin-users">{{ __('Users') }}</option>
                                <option
                                        @if(in_array('admin-templates',json_decode($user->user_permissions))) selected @endif
                                value="admin-templates">{{ __('Templates') }}</option>
                                <option
                                        @if(in_array('admin-subscriptions',json_decode($user->user_permissions))) selected @endif
                                value="admin-subscriptions">{{ __('Subscriptions') }}</option>
                                <option
                                        @if(in_array('admin-plans',json_decode($user->user_permissions))) selected @endif
                                value="admin-plans">{{ __('Plans') }}</option>
                            </optgroup>
                        </select>
                    </div>

                    <div class="form-group">
                        {{ Form::label('password', 'Password') }}<br>
                        {{ Form::password('password', array('class' => 'form-control')) }}

                    </div>

                    <div class="form-group">
                        {{ Form::label('password', 'Confirm Password') }}<br>
                        {{ Form::password('password_confirmation', array('class' => 'form-control')) }}

                    </div>

                    {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection