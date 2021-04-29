<x-account-layout>
    <x-slot name="header">
        <div class="d-none d-lg-block">
            <h1 class="h2 text-white">{{ __('My tickets') }}</h1>
        </div>
    </x-slot>
<div class="card">
        <!-- Card header -->
        <div class="card-header">
            <h4 class="mb-0 text-info">#{{ $ticket->ticket_id }} - {{ $ticket->title }}</h4>
        </div>
        <!-- Card body -->
        <div class="card-body">
            <div class="ticket-info">
                <blockquote class="blockquote">
                    <p>{{ $ticket->message }}</p>
                    <footer class="blockquote-footer" style="font-size:14px;">
                        {{ __('Category') }}: <strong>{{ $ticket->category->name }}</strong> |
                        <span>
                            @if($ticket->status == "Open")
                            {{ __('Status') }}: <span class="badge badge-success"> {{ $ticket->status }}</span>
                            @else
                            {{ __('Status') }}: <span class="badge badge-danger"> {{ $ticket->status }}</span>
                            @endif
                        </span> |
                        <cite>{{ __('Created') }} : {{ $ticket->created_at->diffForHumans() }}</cite>
                    </footer>
                </blockquote>
            </div>
            <hr>
            @include('tickets.comments')
            <hr>
            @include('tickets.reply')

            <form action="{{ route('ticket.close_by_user') }}" method="POST" class="form">
                {{ method_field('POST') }}
                {!! csrf_field() !!}

                <input type="hidden" name="ticket_id" value="{{ $ticket->ticket_id }}">
                
                @if ($ticket->status == 'Open')
                    <button type="submit" class="btn btn-danger mt-2">Close Ticket <i class="fas fa-times-circle"></i> </button> 
                @endif

            </form>
        </div>
</div>

@push('styles')
    <style>
        .bg-gradient-primary{
            background-color: #22335b61;
            border: 0.0825rem solid #e7eaf3
        }
    </style>
@endpush
</x-account-layout>