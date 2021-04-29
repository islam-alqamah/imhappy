@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => 'Suppor Ticket Status',
        'level' => 'h2',
    ])
    @include('beautymail::templates.sunny.contentStart')

    <p>
        {{ __('Hello') }} {{ ucfirst($ticketOwner->name) }},
    </p>
    <p>
        {{ __('Your support ticket with ID') }} #{{ $ticket->ticket_id }} {{ __('has been marked has resolved and closed') }}.
    </p>
    
    @include('beautymail::templates.sunny.contentEnd')

    @include('beautymail::templates.sunny.button', [
        	'title' => 'You can view the ticket at any time at',
        	'link' => url('tickets/'. $ticket->ticket_id)
    ])

@stop
