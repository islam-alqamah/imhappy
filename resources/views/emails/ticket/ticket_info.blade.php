@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => 'Suppor Ticket Information',
        'level' => 'h2',
    ])
    @include('beautymail::templates.sunny.contentStart')

    <p> {{ __('Thank you') }} {{ ucfirst($user->name) }} {{ __('for contacting our support team. A support ticket has been opened for you.
        You will be notified when a response is made by email. The details of your ticket are shown below:') }} </p>
    <p>{{ __('Title') }}: {{ $ticket->title }}</p>
    <p>{{ __('Priority') }}: {{ $ticket->priority }}</p>
    <p>{{ __('Status') }}: {{ $ticket->status }}</p>
    
    @include('beautymail::templates.sunny.contentEnd')

    @include('beautymail::templates.sunny.button', [
        	'title' => 'You can view the ticket at any time at',
        	'link' => url('tickets/'. $ticket->ticket_id)
    ])

@stop
