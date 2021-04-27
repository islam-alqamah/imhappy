<x-account-layout>
    <x-slot name="header">
        <div class="d-none d-lg-block">
            <h1 class="h2 text-white">{{ __('Invoices')  }}</h1>
        </div>
    </x-slot>
 <!-- Card -->
 <div class="card">
    <!-- Header -->
    <div class="card-header">
      <h5 class="card-header-title">{{ __('Invoice history') }}</h5>
    </div>
    <!-- End Header -->

    <!-- Table -->
    <div class="table-responsive">
      <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle">
        <thead class="thead-light">
          <tr>
            <th>{{ __('Reference') }}</th>
            <th>{{ __('Status') }}</th>
            <th>{{ __('Amount') }}</th>
            <th>{{ __('Date') }}</th>
            <th>{{ __('Invoice') }}</th>
            <th style="width: 5%;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($invoices as $invoice)
          <tr>
            <td><a href="#">{{ $invoice->number }}</a></td>
            <td><span class="badge badge-success">{{ $invoice->status }}</span></td>
            <td>{{ $invoice->total() }}</td>
            <td>{{ $invoice->date()->toFormattedDateString() }}</td>
            <td><a class="btn btn-sm btn-info" href="{{ route('account.subscriptions.invoice', $invoice->id) }}"><i class="fas fa-file-download mr-1"></i> PDF</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- End Table -->
  </div>
  <!-- End Card -->

</x-account-layout>
