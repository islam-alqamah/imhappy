@extends('layouts.admin')

@section('title', '| Subscriptions')
@section('content')
    <div class="row">

        <div class="col-md-12 mt-20">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark"> {{ __('Subscriptions') }}</h6>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap" >
                            <table id="example" class="table table-hover mb-0">
                                <thead>
                                <tr>
                                    <th>{{ __('User Name') }}</th>
                                    <th>{{ __('User Email') }}</th>
                                    <th>{{ __('Company Name') }}</th>
                                    <th>{{ __('Plan') }}</th>
                                    <th>{{ __('Start') }}</th>
                                    <th>{{ __('End') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Options') }}</th>
                                    <th>{{ __('Invoice') }}</th>
                                    <th>{{ __('Updated By') }}</th>
                                    <th>{{ __('Updated At') }}</th>
                                    <th>{{ __('Subscribed By') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($subscriptions as $subscribe)
                                    <tr>
                                        <form method="post" action="{{ route('admin.subscribe.update',['id'=>$subscribe->id]) }}">
                                            @csrf
                                        <td>{{ $subscribe->user->name }}</td>
                                        <td>{{ $subscribe->user->email }}</td>
                                        <td>{{ $subscribe->user->team->settings->company_name }}</td>
                                        <td>
                                            <span>{{ $subscribe->plan->title }}</span>
                                        <select class="select2" name="plan_id" style="display: none" data-id="item_{{$subscribe->id}}">
                                            @foreach($plans as $plan)
                                            <option @if($plan->id == $subscribe->plan->id) selected @endif value="{{ $plan->id }}">{{ $plan->title }}</option>
                                            @endforeach
                                        </select>
                                        </td>
                                        <td>{{ $subscribe->starts_at }}</td>
                                        <td><span>{{ $subscribe->ends_at }}</span>
                                        <input type="date" name="ends_at" data-id="item_{{$subscribe->id}}" style="display: none"  value="{{ $subscribe->ends_at }}">
                                        </td>
                                        <td>{!!  ($subscribe->ends_at > Carbon\Carbon::today())?'<span class="badge badge-success">'.__('Active').'</span>':'<span class="badge badge-warning">'.__('Expired').'</span>' !!}</td>
                                        <td>
                                            <button data-id="{{$subscribe->id}}" type="button" class="btn btn-sm btn-primary edit"><i class="fa fa-edit"></i></button>
                                            <button type="submit"  data-id="{{$subscribe->id}}" style="display: none" class="update btn btn-sm btn-primary">
                                                <i class="fa fa-check"></i><i class="fa fa-save"></i></button>
                                        </td>
                                        <td>@if($subscribe->payment_id!=0)<a href="{{ url('admin/invoice/').'/'.$subscribe->payment_id }}"
                                               class="btn btn-sm btn-primary"><i class="fa fa-file"></i></a>@endif </td>
                                        <td> {{ $subscribe->updated_by }} </td>
                                        <td> {{ $subscribe->updated_at }} </td>
                                        <td> {{ $subscribe->subscribed_by }} </td>
                                        </form>
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
        $(function(){
            $('.edit').click(function (){
                var item_id = $(this).attr('data-id');
                console.log(item_id);
                $(this).hide();
                $('select[data-id="item_'+item_id+'"]').parent().children('span').remove();
                $('select[data-id="item_'+item_id+'"]').show();

                $('input[data-id="item_'+item_id+'"]').parent().children('span').remove();
                $('input[data-id="item_'+item_id+'"]').show();
                $('.update[data-id="'+item_id+'"]').show();
            });
        })
    </script>
@endsection