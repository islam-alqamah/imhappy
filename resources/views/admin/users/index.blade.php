@extends('layouts.admin')

@section('title', '| Users')

@section('content')
    <div class="fixed-sidebar-right" >
        <ul class="right-sidebar" style="background: #f8f8f8;overflow: auto">
            <li>

                        <form action="{{ route('admin.users.new') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="control-label mb-5" for="city">
                                        {{ __('Company name') }}
                                    </label>

                                    <input type="text" required name="name" class="form-control" id="city" placeholder="">

                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-5" for="city">
                                        {{ __('Email') }}
                                    </label>

                                    <input type="text" required name="email" class="form-control" id="city" placeholder="">

                                </div>

                                <div class="form-group">
                                    <label class="control-label mb-5" for="password">
                                        {{ __('Password') }}
                                    </label>

                                    <input type="password" required name="password" class="form-control" id="password" placeholder="">

                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-5" >
                                        {{ __('Permissions') }}
                                    </label>
                                    <select class="form-control select2" multiple name="permissions[]" >
                                        <option value="dashboard">{{ __('Dashboard') }}</option>
                                        <option value="charts">{{ __('Charts & Analytics') }}</option>
                                        <option value="reports">{{ __('Reports') }}</option>
                                        <option value="branches">{{ __('Branches') }}</option>
                                        <option value="points">{{ __('Points') }}</option>
                                        <optgroup label="{{__('Account')}}">
                                            <option value="account-settings">{{ __('Settings') }}</option>
                                            <option value="account-payments">{{ __('Payments') }}</option>
                                        </optgroup>
                                        <optgroup label="{{__('Admin')}}">
                                            <option selected value="admin-users">{{ __('Users') }}</option>
                                            <option selected value="admin-templates">{{ __('Templates') }}</option>
                                            <option selected value="admin-subscriptions">{{ __('Subscriptions') }}</option>
                                            <option selected value="admin-plans">{{ __('Plans') }}</option>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-5" for="city">
                                        {{ __('Subscribe to Plan') }}
                                    </label>
                                    <select class="form-control select2" name="plan_id" >
                                        <option value="0">{{ __('Trial') }}</option>
                                        @foreach($plans as $plan)
                                            <option value="{{ $plan->id }}">{{ $plan->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-outline fancy-button btn-0 pull-right "><i class="fa fa-floppy-o"></i> {{ __('Save') }}</button>

                            </div>
                        </form>


            </li>
        </ul>
    </div>

    <div class="row">

        <div class="col-md-12 mt-20">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark"> {{ __('Users') }}</h6>
                    </div>
                    <div class="pull-right">
                        <button href="#" id="open_right_sidebar" class="btn btn-primary btn-outline fancy-button btn-0 btn-xs">
                            <i class="fa fa-plus" style="color: #fff"></i>
                        </button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap table-responsive" >
                            <table id="example" class="table tabel-res table-hover mb-0">
                                <thead>
                                <tr>
                                    <th>{{ __('Avatar') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Verification') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Plan') }}</th>
                                    <th>{{ __('Branches') }}</th>
                                    <th>{{ __('Points') }}</th>
                                    <th>{{ __('Responses') }}</th>
                                    <th>{{ __('Options') }}</th>
                                    <th>{{ __('Updated At') }}</th>
                                    <th>{{ __('Updated By') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td><img src="{{ $user->profile_photo_url }}" class="img-fluid rounded-circle avatar"/></td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{!!  $user->isVerified()?'<span class="badge badge-success">'.__('Verified').'</span>':'<span class="badge badge-warning">'.__('Unverified').'</span>' !!}</td>
                                        <td>

                                            <a href="{{ url('admin/user/toggle/'.$user->id) }}">@if  ($user->isActive())
                                                    <input type="checkbox" checked="" class="js-switch js-switch-1"  data-size="small" data-secondary-color="#f0c541"  data-color="#2ecd99" data-switchery="true" >
                                                <small>{{__('Active')}}</small>
                                                @else
                                                    <input type="checkbox" class="js-switch js-switch-1" data-size="small" data-secondary-color="#f0c541" data-color="#2ecd99" data-switchery="true" >
                                                    <small>{{__('Disabled')}}</small> @endif </a></td>
                                        <td>{{ isset($user->team->subscribe->plan)?$user->team->subscribe->plan->title:__('Trial') }}</td>
                                        <td>{{ isset($user->team->branches)?$user->team->branches->count():0 }}</td>
                                        <td>{{ isset($user->team->points)?$user->team->points->count():0 }}</td>
                                        <td>{{ isset($user->team->responses)?$user->team->responses->count():0 }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <div class="dropdown">
                                                    <button aria-expanded="false" data-toggle="dropdown" style="border:none" class="btn btn-default btn-circle btn-outline dropdown-toggle" type="button">
                                                        <i class="fa fa-bars"></i> <span class="caret"></span></button>
                                                    <ul role="menu" class="dropdown-menu">
                                                        @if(!in_array('admin',explode('<br/>',$user->getRolesLabelAttribute())))<li>
                                                            <a href="{{ route('impersonate', $user->id) }}">
                                                                <i class="fa fa-sign-in"></i> {{ __('Login As').' '.$user->name}}
                                                            </a>
                                                        </li>
                                                        @endif
                                                        <li class="divider"></li>
                                                        <li>
                                                            <a target="_blank" href="{{ route('admin.users.edit', $user) }}">
                                                                <i class="fa fa-edit"></i> {{ __('Edit')}}
                                                            </a>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li>
                                                            <a target="_blank" href="{{ route('admin.users.show', $user) }}">
                                                                <i class="fa fa-laptop"></i> {{ __('Preview')}}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $user->updated_at }}</td>
                                        <td>{{ $user->updated_by }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <!-- Data table JavaScript -->
    @if(App::getLocale()=='ar')
        <script src="{{ url('assets/dist/vendors') }}/bower_components/datatables/media/js/ar.jquery.dataTables.min.js"></script>
    @else
        <script src="{{ url('assets/dist/vendors') }}/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    @endif
    <script src="{{ url('assets/dist/vendors') }}/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ url('assets/dist/vendors') }}/bower_components/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{ url('assets/dist/vendors') }}/bower_components/jszip/dist/jszip.min.js"></script>
    <script src="{{ url('assets/dist/vendors') }}/bower_components/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{ url('assets/dist/vendors') }}/bower_components/pdfmake/build/vfs_fonts.js"></script>

    <script src="{{ url('assets/dist/vendors') }}/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ url('assets/dist/vendors') }}/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
    @if(App::getLocale()=='ar')
        <script src="{{ url('assets/dist/') }}/js/ar.export-table-data.js"></script>
    @else
        <script src="{{ url('assets/dist/') }}/js/export-table-data.js"></script>
    @endif
    <script>

    </script>
@endsection