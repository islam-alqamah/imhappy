@extends('layouts.admin')
@section('content')
<div class="u-body">
    <!-- Doughnut Chart -->
    <div class="row">
        <div class="col-sm-6 col-xl-3 mb-4">
            <div class="card">
                <div class="card-body media align-items-center px-xl-3">
                    <div class="u-doughnut u-doughnut--70 mr-3 mr-xl-2">
                        <i class="fa fa-user icon"></i>
                    </div>

                    <div class="media-body">
                        <h5 class="h6 text-muted text-uppercase mb-2">
                            {{ __('Total Users') }} <i class="fa fa-arrow-up text-success ml-1"></i>
                        </h5>
                        <span class="h1 mb-0">{{ $user_count }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3 mb-4">
            <div class="card">
                <div class="card-body media align-items-center px-xl-3">
                    <div class="u-doughnut u-doughnut--70 mr-3 mr-xl-2">
                        <i class="fas fa-ticket-alt icon"></i>
                    </div>
                    <div class="media-body">
                        <h5 class="h6 text-muted text-uppercase mb-2">
                            {{ __('New Tickets') }} <i class="fa fa-arrow-down text-danger ml-1"></i>
                        </h5>
                        <span class="h2 mb-0">{{ $newTicket }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3 mb-4">
            <div class="card">
                <div class="card-body media align-items-center px-xl-3">
                    <div class="u-doughnut u-doughnut--70 mr-3 mr-xl-2">
                        <i class="fas fa-receipt icon"></i>
                    </div>

                    <div class="media-body">
                        <h5 class="h6 text-muted text-uppercase mb-2">
                            {{ __('Total subscribers') }} <i class="fa fa-arrow-up text-success ml-1"></i>
                        </h5>
                        <span class="h2 mb-0">{{ $total_subscription }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3 mb-4">
            <div class="card">
                <div class="card-body media align-items-center px-xl-3">
                    <div class="u-doughnut u-doughnut--70 mr-3 mr-xl-2">
                        <i class="fa fa-users icon"></i>
                    </div>

                    <div class="media-body">
                        <h5 class="h6 text-muted text-uppercase mb-2">
                            {{ __('Teams') }} <i class="fa fa-arrow-up text-danger ml-1"></i>
                        </h5>
                        <span class="h2 mb-0">{{ $team_count }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Doughnut Chart -->

    <!-- Overall Income -->
    <div class="card mb-4">
        <!-- Card Header -->
        <header class="card-header d-md-flex align-items-center">
            <h2 class="h3 card-header-title">{{ __('Statistics') }}</h2>
        </header>
        <!-- End Card Header -->

        <!-- Card Body -->
        <div class="card-body">
            <div id="chart" style="height: 300px;"></div>

        </div>
        <!-- End Card Body -->
    </div>
    <!-- End Overall Income -->

    
</div>
@endsection
@push('styles')
    <style>
        .icon{
            font-size:26px;
            color:slategrey;
        }
        .u-doughnut--70 {
            width: 40px;
            height: 50px;
        }
    </style>
@endpush

@push('scripts')
   <!-- Charting library -->
   <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
   <!-- Chartisan -->
   <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <script>
        const chart = new Chartisan({
        el: '#chart',
        url: "@chart('users_chart')",
      });
    </script>
@endpush