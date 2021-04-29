@extends('layouts.admin')

@section('title', '| Users')

@section('content')
    <div class="u-body">
        <h1 class="h2 font-weight-semibold mb-4">{{ __('User Administration') }}</h1>

        <div class="card mb-4">

            <div class="card-body">
                <livewire:show-users />
            </div>
        </div>
    </div>
@endsection