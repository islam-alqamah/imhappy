@extends('layouts.account')

@section('title', '| Edit User')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit User') }}: {{$user->name}}</div>

                <div class="card-body">
                    {{ Form::model($user, array('route' => array('account.users.update', $user->id), 'method' => 'POST')) }}
                    {{-- Form model binding to automatically populate our fields with user data --}}

                    <div class="form-group">
                        {{ Form::label('name', 'Name') }}
                        {{ Form::text('name', null, array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('email', 'Email') }}
                        {{ Form::email('email', null, array('class' => 'form-control','disabled'=>'disabled')) }}
                    </div>




                    <div class="form-group">
                        {{ Form::label('password', 'Password') }}<br>
                        {{ Form::password('password', array('class' => 'form-control')) }}

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
                        </select>
                    </div>

                    {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection