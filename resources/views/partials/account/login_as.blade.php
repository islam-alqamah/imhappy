@impersonating
    <div class="alert alert-soft-danger media" role="alert">
        <div class="media-body text-center" role="alert">
            <i class="fas fa-info-circle mt-1 mr-1"></i>
            @lang('You are currently logged in as :name.', ['name' => auth()->user()->name]) 
            <a class="btn btn-xs btn-soft-indigo" href="{{ route('impersonate.leave') }}">
                {{ __('Leave impersonation') }}
            </a>
        </div>
      </div>
@endImpersonating