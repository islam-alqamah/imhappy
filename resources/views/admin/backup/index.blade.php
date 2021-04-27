@extends('layouts.admin')

@section('title', '| Users')

@section('content')
    <div class="u-body">
        <h1 class="h2 font-weight-semibold mb-4">{{ __('App Backup') }}</h1>

        <div class="card mb-4">
            <div class="card-body backup">
                <div class="container mb-5">
        
                    <livewire:backup />
                </div>    
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
          table thead th {
        text-transform: uppercase;
        font-size: 0.7rem;
        font-weight:600;
        color: dimgrey;
        background-color: #f4f7fa;
        padding-top: 0.45rem;
        padding-bottom: 0.45rem;
        border-top: none;
        letter-spacing: 0.05rem;
    }
    .table-hover tbody tr:hover {
        background-color: #f6fbff;
    }
    .backup.card {
        border-radius: 0.45rem;
    }
    .backup.card-body {
        background-color: #f5f7fb;
        padding: 0;
    }
    .container {
        padding:0;
        margin:0;
    }
    .backup.card-header {
        background-color: #fff;
        padding: 0.75rem;
    }
    .card-header:first-child {
        border-radius: calc(0.45rem - 1px) calc(0.45rem - 1px) 0 0;
    }
    .btn {
        border-radius: 0.45rem;
        padding: 0.2rem 1.1rem;
    }
    .btn-refresh {
        font-size: 0.9rem;
        line-height: 1.6;
    }
    .btn-refresh.loading svg {
        animation: loading-spinner 1s linear infinite;
    }
    @keyframes loading-spinner {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }
    </style>
@endpush