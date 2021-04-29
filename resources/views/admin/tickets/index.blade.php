@extends('layouts.account')

@section('content')
<div class="u-body">
    <h1 class="h2 font-weight-semibold mb-4">{{ __('User Administration') }}</h1>
        <div class="card mb-3">
            <div class="card-body">
                @if ($tickets->isEmpty())
                <p>{{ __('There are currently no tickets.') }}</p>
                @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Last Updated') }}</th>
                            <th style="text-align:center" colspan="2">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                        <tr>
                            <td>
                                {{ $ticket->category->name }}
                            </td>
                            <td>
                                <a href="{{ url('admin/tickets/'. $ticket->ticket_id) }}">
                                    #{{ $ticket->ticket_id }} - {{ $ticket->title }}
                                </a>
                            </td>
                            <td>
                                @if ($ticket->status === 'Open')
                                <span class="badge badge-success"> {{ $ticket->status }}</span>
                                @else
                                <span class="badge badge-danger"> {{ $ticket->status }}</span>
                                @endif
                            </td>
                            <td>{{ $ticket->updated_at->diffForHumans() }}</td>
                            <td class="float-right">
                                @if($ticket->status === 'Open')
                                <a href="{{ url('admin/tickets/' . $ticket->ticket_id) }}" class="btn btn-info"><i class="fas fa-comment-dots"></i></a>

                                <form action="{{ url('admin/close_ticket/' . $ticket->ticket_id) }}" method="POST" style="display: inline-block;">
                                    {!! csrf_field() !!}
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-times-circle"></i></button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $tickets->render() }}
                @endif
        </div>
    </div>
</div>
@endsection