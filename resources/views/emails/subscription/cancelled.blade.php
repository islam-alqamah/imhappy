@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => __('Subscription Cancelled'),
        'level' => 'h2',
    ])
    @include('beautymail::templates.sunny.contentStart')

    <p> {{ __('Hello ') }} 
        {{ ucfirst($user->name) }}, 
        <br><br>
        {{ __('You have cancelled your subscription.') }}
    </p>
    <p>
        {{ __('Some features and services may not be accessible.
        Login into your account to learn more.') }}
    </p>
    <p>
        {{ __('Thanks') }},<br>
        {{ config('app.name') }}
    </p>
    @include('beautymail::templates.sunny.contentEnd')

    @include('beautymail::templates.sunny.button', [
        	'title' => __('Login to your account'),
        	'link' => url('login')
    ])

@stop
