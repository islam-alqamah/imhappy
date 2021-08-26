@extends('layouts.admin')

@section('title', '| Plans')

@section('content')
    <div class="row">

        <div class="col-md-12 mt-20">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark"> {{ __('Plans') }}</h6>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap" >
                            <table id="example" class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Annual Price') }}</th>
                            <th>{{ __('Branches Limit') }}</th>
                            <th>{{ __('Points Limit') }}</th>
                            <th>{{ __('Channels') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th class="float-right">{{ __('Options') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plans as $plan )
                        <tr>
                            <td>{{ $plan->title }}</td>
                            <td>{{ $plan->price }}</td>
                            <td>{{ $plan->annual_price }}</td>
                            <td>{{ $plan->branches }}</td>
                            <td>{{ $plan->points }}</td>
                            <td>{{ $plan->channels }}</td>
                            <td>
                                @if ($plan->active === 1)
                                <span class="badge badge-success"> {{ __('Active') }}</span>
                                @else
                                <span class="badge badge-danger"> {{ __('Disabled') }}</span>
                                @endif
                            </td>
                            <td class="float-right">
                                <div class="btn-group">
                                    <div class="dropdown">
                                        <button aria-expanded="false" data-toggle="dropdown" style="border:none" class="btn btn-default btn-circle btn-outline dropdown-toggle" type="button">
                                            <i class="fa fa-bars"></i> <span class="caret"></span></button>
                                        <ul role="menu" class="dropdown-menu">
                                            <li>
                                                <a href="{{ URL::to('admin/plans/' . $plan->id . '/edit') }}">
                                                    <i class="fa fa-edit"></i> {{ __('Edit') }}
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="#" onclick="document.getElementById('delete').submit()">
                                                    <i class="fa fa-trash"></i> {{ __('Delete') }}
                                                </a>
                                                <form id="delete" action="{{ route('admin.plans.destroy', $plan->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </td>
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