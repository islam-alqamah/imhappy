@extends('layouts.admin')

@section('title', '| Permissions')

@section('content')
<div class="container">
    <div class="row">
        <div class="col float-left">
        <h3><i class="fa fa-key"></i>{{ __('Available Permissions') }}</h3>
        </div>
        <div class="col float-right">
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary btn-sm float-right">Users</a>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-primary btn-sm float-right">Roles</a>
        </div>
    </div>
    <hr>
    <div class="card" style="margin-bottom: 10px; ">
    <div class="table-responsive">
        <table class="table table-bordered table-striped" style="margin-bottom: 0px;">

            <thead>
                <tr>
                    <th>{{ __('Permissions') }}</th>
                    <th>{{ __('Operation') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td> 
                    <td>
                    <a href="{{ URL::to('admin/permissions/'.$permission->id.'/edit') }}" class="btn btn-info btn-sm float-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['admin.permissions.destroy', $permission->id] ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                    {!! Form::close() !!}

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    <a href="{{ URL::to('admin/permissions/create') }}" class="btn btn-success btn-md">Add Permission</a>

</div>

@endsection