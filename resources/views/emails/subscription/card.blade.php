@component('mail::message')
# Card Updated

{{--Hello {{ $user->first_name }},--}}
@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => __('Payment Updated'),
        'level' => 'h2',
    ])
    @include('beautymail::templates.sunny.contentStart')

    <p> {{ __('Hello ') }} {{ ucfirst($user->name) }} <br>
        {{ __('Your payment details have been updated.') }}
    </p>
    <p>
        {{ __('You can login into your account and change the card anytime.') }}
    </p>
    <p>
        {{ __('Thanks') }},<br>
        {{ config('app.name') }}
    </p>
    @include('beautymail::templates.sunny.contentEnd')

    @include('beautymail::templates.sunny.button', [
        	'title' => __('View my account'),
        	'link' => url('login')
    ])

@stop
