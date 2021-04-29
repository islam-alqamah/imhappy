<div class="card">
    <div class="card-header">
      <h5 class="card-title">{{ __('Preferences') }}</h5>
    </div>

    <!-- Body -->
    <div class="card-body">
      <!-- Form -->
      <form>
        <!-- Form Group -->
        <div class="row form-group">
          <label for="languageLabel" class="col-sm-3 col-form-label input-label">{{ __('Language') }}</label>

          <div class="col-sm-9">
            <!-- Select -->
            <select class="form-control" id="languageLabel" wire:model.defer='language'
                @foreach (language()->allowed() as $code => $name)
                    <option value="{{ $code }}" data-option-template='<img class="avatar avatar-xss avatar-circle mr-2" src="{{ asset('saas/svg/flags/'.$code.'.svg') }}" alt="Image description" width="16"/><span>{{ $name }}</span>'>{{ $name }}</option>
                @endforeach
            </select>
            <!-- End Select -->
          </div>
        </div>
        <!-- End Form Group -->

        <!-- Form Group -->
        <div class="row form-group">
          <label for="timeZoneLabel" class="col-sm-3 col-form-label input-label">Time zone</label>

          <div class="col-sm-9">
            <input type="text" class="form-control" wire:model.defer="timezone" name="currentPassword" id="timeZoneLabel" placeholder="Your time zone" aria-label="Your time zone" readonly>
          </div>
        </div>
        <!-- End Form Group -->

        <!-- Toggle Switch -->
        <label class="row form-group toggle-switch mb-3" for="preferencesSwitch1">
          <span class="col-8 col-sm-9 toggle-switch-content ml-0">
            <span class="card-text text-dark mb-0">Early release</span>
            <span class="card-text font-size-1">Get included on early releases for new Front features.</span>
          </span>
          <span class="col-4 col-sm-3">
            <input type="checkbox" class="toggle-switch-input" id="preferencesSwitch1">
            <span class="toggle-switch-label ml-auto">
              <span class="toggle-switch-indicator"></span>
            </span>
          </span>
        </label>
        <!-- End Toggle Switch -->

        <!-- Toggle Switch -->
        <label class="row form-group toggle-switch mb-3" for="preferencesSwitch2">
          <span class="col-8 col-sm-9 toggle-switch-content ml-0">
            <span class="card-text text-dark mb-0">See info about people who view my profile</span>
            <span class="card-text font-size-1"><a class="link" href="#">More about viewer info</a>.</span>
          </span>
          <span class="col-4 col-sm-3">
            <input type="checkbox" class="toggle-switch-input" id="preferencesSwitch2" checked>
            <span class="toggle-switch-label ml-auto">
              <span class="toggle-switch-indicator"></span>
            </span>
          </span>
        </label>
        <!-- End Toggle Switch -->

        <div class="d-flex justify-content-end">
          <a class="btn btn-white" href="javascript:;">Cancel</a>
          <span class="mx-2"></span>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
      <!-- End Form -->
    </div>
    <!-- End Body -->
  
</div>
