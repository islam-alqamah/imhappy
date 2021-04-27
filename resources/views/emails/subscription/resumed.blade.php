@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => __('Subscription Resumed'),
        'level' => 'h2',
    ])
    @include('beautymail::templates.sunny.contentStart')

    <p> {{ __('Hello ') }} {{ ucfirst($user->name) }} <br>
        {{ __('You have successfully resumed your subscription.') }}
    </p>
    <p>
        {{ __('You can login into your account and change subscription anytime.') }}
    </p>
    @include('beautymail::templates.sunny.contentEnd')

    @include('beautymail::templates.sunny.button', [
        	'title' => __('View my account'),
        	'link' => url('login')
    ])

@stop

