@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => __('Subscription Plan Changed'),
        'level' => 'h2',
    ])
    @include('beautymail::templates.sunny.contentStart')

    <p> {{ __('Hello ') }} {{ ucfirst($user->name) }} <br>
        {{ __('Your subscription has been changed.') }}
    </p>
    <p>
        {{ __('Some features and services may not be accessible according to the plan your are currently on.
        Login into your account to see the changes.') }}
    </p>

    @include('beautymail::templates.sunny.contentEnd')

    @include('beautymail::templates.sunny.button', [
        	'title' => __('View my account'),
        	'link' => url('login')
    ])

@stop
