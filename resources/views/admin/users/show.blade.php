@extends('layouts.admin')

@section('title', '| Users')

@section('content')
<div class="u-body">
    <h1 class="h2 font-weight-semibold mb-4">{{ __('User Administration') }}</h1>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="card">
                <div class="card-header">
                    {{ __('View User') }}

                    <div class="card-header-actions float-right">
                        <a href="{{ route('admin.users.index') }}" class="card-header-action">{{ __('Back') }}</a>
                    </div>
                    <!--card-header-actions-->
                </div>
                <!--card-header-->

                <div class="card-body">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>{{ __('Type') }}</th>
                                <td>{{ __('Administrator') }}</td>
                            </tr>

                            <tr>
                                <th>{{ __('Avatar') }}</th>
                                <td><img width="100" src="{{ $user->profile_photo_url }}"
                                        class="user-profile-image"></td>
                            </tr>

                            <tr>
                                <th>{{ __('Name') }}</th>
                                <td>{{ $user->name }}</td>
                            </tr>

                            <tr>
                                <th>{{ __('E-mail Address') }}</th>
                                <td>{{ $user->email }}</td>
                            </tr>

                            <tr>
                                <th>{{ __('Status') }}</th>
                                <td>
                                    {!! $user->active ? "<span class='badge badge-success'>Active</span>" : "<span class='badge badge-danger'>Inactive</span> " !!}
                                </td>
                            </tr>

                            <tr>
                                <th>{{ __('Verified') }}</th>
                                <td>
                                    @if ($user->email_verified_at != null)
                                    <span class="badge badge-success" data-toggle="tooltip" title=""
                                        data-original-title="{{ $user->email_verified_at->toDayDateTimeString() }}">
                                        {{ __('Yes') }}
                                    </span> 
                                    @else
                                    <span class="badge badge-danger" data-toggle="tooltip" title=""
                                        data-original-title="">
                                        {{ __('No') }}
                                    </span> 
                                    @endif
    
                                    
                                </td>
                            </tr>

                            <tr>
                                <th>{{ __('2FA') }}</th>
                                <td>
                                    @if ($user->two_factor_secret != null)
                                    <span class="badge badge-danger">
                                        {{ __('Yes') }}
                                    </span>
                                    @else
                                    <span class="badge badge-danger">
                                        {{ __('No') }}
                                    </span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th>{{ __('Timezone') }}</th>
                                <td>{{ $user->timezone }}</td>
                            </tr>

                            <tr>
                                <th>{{ __('Last Login At') }}</th>
                                <td>
                                    {{ $user->last_login_at->toDayDateTimeString() }} </td>
                            </tr>

                            <tr>
                                <th>{{ __('Last Known IP Address') }}</th>
                                <td>{{ $user->last_login_ip }}</td>
                            </tr>


                            <tr>
                                <th>{{ __('Roles') }}</th>
                                <td>{{ __('All') }}</td>
                            </tr>

                            <tr>
                                <th>{{ __('Additional Permissions') }}</th>
                                <td>{{ __('All') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!--card-body-->

                <div class="card-footer">
                    <small class="float-right text-muted">
                        <strong>{{ __('Account Created') }}:</strong> {{ $user->created_at->toDayDateTimeString() }} ({{ $user->created_at->diffForHumans() }}),
                        <strong>{{ __('Last Updated') }}:</strong> {{ $user->updated_at->toDayDateTimeString() }} ({{ $user->updated_at->diffForHumans() }})

                    </small>
                </div>
                <!--card-footer-->
            </div>
            <!--card-->

        </div>
        <!--fade-in-->
    </div>
</div>
@endsection