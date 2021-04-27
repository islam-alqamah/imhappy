@component('mail::message')

@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => __('New Contact form email'),
        'level' => 'h2',
    ])
    @include('beautymail::templates.sunny.contentStart')

    <p> {{ __('Hello ') }} Admin, <br>
        {{ __('Contact from enquery from') }} : {{ $name }}
        <p> <strong>{{ __('Name') }}:</strong> {{ $name }} </p>
        <p> <strong>{{ __('Subject') }}:</strong> {{ $subject }} </p>
        <p> <strong>{{ __('Email') }}:</strong> {{ $email }} </p>
        <p> <strong>{{ __('Phone') }}:</strong> {{ $phone }} </p>
        <p> <strong>{{ __('Message') }}:</strong> {{ $comment }} </p>
    </p>
    <p>
        {{ __('Thanks') }},<br>
        {{ config('app.name') }}
    </p>
    @include('beautymail::templates.sunny.contentEnd')

@stop
