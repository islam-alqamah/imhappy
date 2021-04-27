@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => 'Support Ticket',
        'level' => 'h2',
    ])
    @include('beautymail::templates.sunny.contentStart')

    <p>
        {{ $comment->comment }}
    </p>
     
    ---
    <p>{{ __('Replied by') }}: {{ $user->name }}</p>
     
    <p>{{ __('Title') }}: {{ $ticket->title }}</p>
    <p>{{ __('Ticket ID') }}: {{ $ticket->ticket_id }}</p>
    <p>{{ __('Status') }}: {{ $ticket->status }}</p>
    
    @include('beautymail::templates.sunny.contentEnd')

    @include('beautymail::templates.sunny.button', [
        	'title' => 'You can view the ticket at any time at',
        	'link' => url('account/tickets/'. $ticket->ticket_id)
    ])

@stop
