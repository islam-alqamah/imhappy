<x-account-layout>
    <x-slot name="header">
        <div class="d-none d-lg-block">
            <h1 class="h2 text-white">{{ __('My tickets') }}</h1>
        </div>
    </x-slot>
<div class="card">
    <!-- Card header -->
    <div class="card-header">
        <!-- Title -->
        <h5 class="h3 mb-0">
            {{ __('My tickets') }}
        </h5>
        <span class="float-right">
            <a href="{{ route('ticket.create') }}" class="btn btn-soft-indigo btn-sm">
                <i class="fas fa-plus"></i> {{ __('Create New Ticket') }}
            </a>
        </span>
    </div>
    <div class="card-body">
        @if($tickets->isEmpty())
                <h4 class="text-center">{{ __('You have not created any tickets.') }}</h4>
                @else
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>{{ __('Category') }}</th>
                                <th>{{ __('Title') }}</th>
                                {{-- <th>{{ __('Domain') }}</th> --}}
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Last Updated') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tickets as $ticket)
                            <tr>
                                <td>
                                    <h5>{{ $ticket->category->name }}</h5>
                                </td>
                                <td>
                                    <a href="{{ url('account/tickets/' . $ticket->ticket_id) }}">
                                        #{{ $ticket->ticket_id }} - {{ $ticket->title }}
                                    </a>
                                </td>
                                {{-- <td>
                                    <h5>{{ $ticket->domain }}</h5>
                                </td> --}}
                                <td>
                                    <span class="badge badge-dot mr-4">
                                        @if($ticket->status == "Open")
                                        <span class="badge badge-success"> {{ $ticket->status }}</span>
                                        @else
                                        <span class="badge badge-danger"> {{ $ticket->status }}</span>
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($ticket->updated_at)->diffForHumans() }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $tickets->render() }}
                @endif
    </div>
</div>
</x-account-layout>