@extends('layouts.admin')

@section('content')
<div class="u-body">
    <h1 class="h2 font-weight-semibold mb-4">#{{ $ticket->ticket_id }} - {{ $ticket->title }}</h1>
    <div class="card">
        <!-- Card body -->
        <div class="card-body">
                    <div class="ticket-info">
                        <blockquote class="blockquote">
                        <h5>{{ $ticket->message }}</h5>
                        <footer class="blockquote-footer" style="font-size:14px; display:flex">
                            {{ __('Category') }}: <strong>{{ $ticket->category->name }}</strong> | 
                                <span>
                                    @if($ticket->status == "Open")
                                    {{ __('Status') }}: <i class="bg-success" style="width: 0.5rem; height: 0.5rem;"></i> <span class="status bg-success px-1"> {{ $ticket->status }}</span>
                                    @else
                                    {{ __('Status') }}: <i class="bg-danger" style="height: 0.5rem; width: 0.5rem"></i> <span class="status bg-danger px-1">{{ $ticket->status }}</span>
                                    @endif
                                </span>  |
                                {{-- Domain: <strong>{{ $ticket->domain }}</strong> | Plan: <strong>{{ $ticket->subscription }}</strong> | --}}
                                <cite>Created : {{ $ticket->created_at->diffForHumans() }}</cite>
                                <a href="{{ route('impersonate', $ticket->user->id) }}" title="{{ __('Impersonate user') }}" style="padding: 3px; margin-left:8px" class="btn btn-default float-left"><i class="fa fa-user-secret" style="color: black" aria-hidden="true"></i> {{ __('impersonate user') }}</a>
                        </footer>
                        </blockquote>
                    </div>
                    <hr>
                    @include('tickets.comments')
                    <hr>
                    @include('tickets.reply')
            </div>
        </div>
    </div>

@endsection