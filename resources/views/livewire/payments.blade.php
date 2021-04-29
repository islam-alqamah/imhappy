<div>
    <div class="card-body">
        <div class="mb-4">
          <p>{{ __('Cards will be charged either at the end of the month or whenever your balance exceeds the usage threshold. All major credit / debit cards accepted.') }}</p>
        </div>
    
        <!-- List Group -->
        <ul class="mb-5 list-group">
          <!-- List Item -->
          @foreach ($paymentMethods as $payment)
          <li class="list-group-item">
            <div class="mb-2">
              <h5>{{ optional(optional($payment)->billing_details)->name }}
                @if ($payment->card->last4  == currentTeam()->card_last_four)
                   <span class="ml-1 badge badge-success">{{ __('Default') }}</span> 
                @endif 
              </h5>
            </div>
    
            <div class="media">
              <img class="mr-3 avatar-sm" src="{{ asset("saas/svg/brands/". $payment->card->brand.".svg") }}" alt="Image Description">
    
              <div class="media-body">
                <div class="row">
                  <div class="mb-3 col-sm mb-sm-0">
                    <span class="d-block text-dark">{{ $payment->card->brand }}•••• {{ $payment->card->last4 }}</span>
                    <small class="d-block text-muted">{{ __('Checking - Expires') }} {{ $payment->card->exp_month }}/{{ $payment->card->exp_year }}</small>
                  </div>
    
                  <div class="col-sm-auto">
                    @if ($payment->card->last4  != currentTeam()->card_last_four)
                    <button class="mr-2 btn btn-sm btn-white" wire:click="makeDefault('{{ $payment->id }}')" href="javascript:;">
                        <span wire:loading.remove wire:target="makeDefault"><i class="mr-1 fas fa-credit-card"></i> {{ __('Make default') }}</span>
                        <span wire:loading wire:target="makeDefault">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Processing...
                        </span>
                    </button>
                    <button type="button" wire:loading.remove wire:target="delete" wire:click="delete('{{ $payment->id }}')" class="btn btn-sm btn-danger">
                      <span wire:loading.remove wire:target="delete"><i class="mr-1 fas fa-trash-alt"></i> {{ __('Delete') }}</span>
                        <span wire:loading wire:target="delete">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Processing...
                        </span>
                    </button>
                    @endif
                    {{-- <button wire:loading class="btn btn-soft-danger btn-xs" type="button" disabled>
                        
                    </button> --}}
                  </div>
                </div>
                <!-- End Row -->
              </div>
            </div>
          </li>
          @endforeach
          <!-- End List Item -->
        </ul>
        <!-- End List Group -->
    
        <!-- Card -->
        <a class="text-center card card-dashed" href="javascript:;" data-toggle="modal" data-target="#addNewCardModal">
          <div class="card-body card-body-centered card-dashed-body">
            <i class="mb-2 fas fa-credit-card fa-lg"></i>
            {{ __('Add a new card') }}
          </div>
        </a>
        <!-- End Card -->
    </div>
    
      <!-- Add New Card Modal -->
    <div class="modal fade" id="addNewCardModal" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="addNewCardModalTitle">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <!-- Header -->
        <div class="modal-header">
          <h4 id="addNewCardModalTitle" class="modal-title">{{ __('Add new card') }}</h4>
          <div class="modal-close">
            <button type="button" class="btn btn-icon btn-xs btn-ghost-secondary" data-dismiss="modal" aria-label="Close">
              <svg width="14" height="14" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                <path fill="currentColor" d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z"/>
              </svg>
            </button>
          </div>
        </div>
        <!-- End Header -->
    
        <!-- Body -->
        <div class="modal-body">
          {{-- <form> --}}
            <!-- Button Group -->
            <div class="btn-group btn-group-toggle btn-group-segment d-flex form-group" data-toggle="buttons">
              <label class="btn btn-sm flex-fill focus">
                <i class="fas fa-credit-card nav-icon text-success" style="font-size: 20px"></i>
                <input type="radio" name="options" id="option1" checked> {{ __('Credit or Debit card') }}
              </label>
              <label class="btn btn-sm flex-fill disabled">
                <input type="radio" name="options" id="option2"> {{ __('PayPal') }} <span class="badge badge-soft-primary">{{ __('Coming soon') }}</span>
              </label>
            </div>
            <!-- End Button Group -->
            <x:card-form :action="route('account.subscriptions.newcard') ">
                <!-- Custom Checkbox -->
                <div class="mt-2 custom-control custom-checkbox form-group">
                  <input type="checkbox" name="primary" class="custom-control-input" id="makePrimaryCheckbox1">
                  <label class="custom-control-label" for="makePrimaryCheckbox1">{{ __('Make this primary card') }}</label>
                </div>
                <!-- End Custom Checkbox -->
                <button type="submit" class="mt-2 btn btn-success btn-sm" id="card-button" data-secret="{{ currentTeam()->createSetupIntent()->client_secret }}">
                    {{ __('Add new card') }}
                </button>
            </x:card-form>
        </div>
        <!-- End Body -->
      </div>
    </div>
    </div>
    <!-- End Add New Card Modal -->
</div>
