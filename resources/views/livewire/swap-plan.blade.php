<div class="overflow-hidden">
    <div class="container pb-1">
        <!-- Title -->
        <div class="mb-0 text-center w-md-10 w-lg-10 mx-md-auto">
            <h3 class="h3">{{ __('Flexible and transparent pricing') }}</h3>
            <p>{{ __('Whatever your status, our offers evolve according to your needs.') }}</p>
        </div>
        <!-- End Title -->
        <div class="pricing">
            <div class="switch align-self-center">
                <label>{{ __('Monthly') }}</label>
                <input type="checkbox" wire:model="month" wire:change="switchPlan" class="switch" id="switch-id" checked>
                <label for="switch-id">{{ __('Yearly') }}</label><span class="mb-2 ml-2 badge badge-primary">{{ __('Save up to 10%') }}</span>
            </div>
        </div>
        <!-- End Toggle Switch -->
        <!-- Pricing Section -->
        <div class="container">
            <!-- Pricing -->
            <form action="{{ route('account.subscriptions.swap') }}" method="post">
                @csrf
            @foreach($plans as $plan)
            @if ($show == $plan->interval)
            <div
                class="custom-control custom-radio custom-control-inline checkbox-outline checkbox-icon w-100">
                <input type="radio" value="{{ $plan->slug }}" id="pricingRadio {{ $plan->id }}" name="plan"
                    class="custom-control-input checkbox-outline-input checkbox-icon-input" checked>
                <label class="p-4 rounded checkbox-outline-label checkbox-icon-label w-100"
                    for="pricingRadio {{ $plan->id }}">
                    <span class="row">
                        <span class="mb-3 col-sm-3 order-sm-2 text-sm-right mb-sm-0">
                            <span class="mb-2 d-block">
                                <span class="align-top text-primary font-weight-bold">$</span>
                                <span class="font-size-3 text-primary font-weight-bold">{{ $plan->price }}</span>
                                <span class="font-size-1">/ mo</span>
                            </span>
                        </span>
                        <span class="col-sm-9 order-sm-1">
                            <span class="mb-1 d-block h3">{{ $plan->title }}</span>
                            <span class="d-block">{{ __('99GB storage in launch accounts') }}</span>
                        </span>
                    </span>
                </label>
            </div>
            @endif
            @endforeach
            <!-- End Pricing -->
            <!-- End Pricing -->
            <div class="mt-5 text-center">
                <div class="mb-5">
                    <p class="font-size-1">{{ __('Need a custom price ?') }} <a class="font-weight-bold"
                            href="#">{{ __('Contact us for custom pricing') }}</a></p>
                </div>
                <button type="submit"
                    class="btn btn-primary btn-wide transition-3d-hover">{{ __('Swap plan') }}
                </button>
            </div>
            </form>
        </div>
        <!-- End Pricing Section -->
    </div>
</div>
@push('styles')
<style>
.switch {
  font-size: 1rem;
  position: relative;
}
.switch input {
  position: absolute;
  height: 1px;
  width: 1px;
  background: none;
  border: 0;
  clip: rect(0 0 0 0);
  clip-path: inset(50%);
  overflow: hidden;
  padding: 0;
}
.switch input + label {
  position: relative;
  min-width: calc(calc(2.375rem * .8) * 2);
  border-radius: calc(2.375rem * .8);
  height: calc(2.375rem * .8);
  line-height: calc(2.375rem * .8);
  display: inline-block;
  cursor: pointer;
  outline: none;
  user-select: none;
  vertical-align: middle;
  text-indent: calc(calc(calc(2.375rem * .8) * 2) + .5rem);
}
.switch input + label::before,
.switch input + label::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: calc(calc(2.375rem * .8) * 2);
  bottom: 0;
  display: block;
}
.switch input + label::before {
  right: 0;
  background-color: #dee2e6;
  border-radius: calc(2.375rem * .8);
  transition: 0.2s all;
}
.switch input + label::after {
  top: 2px;
  left: 2px;
  width: calc(calc(2.375rem * .8) - calc(2px * 2));
  height: calc(calc(2.375rem * .8) - calc(2px * 2));
  border-radius: 50%;
  background-color: white;
  transition: 0.2s all;
}
.switch input:checked + label::before {
  background-color: #08d;
}
.switch input:checked + label::after {
  margin-left: calc(2.375rem * .8);
}
.switch input:focus + label::before {
  outline: none;
  box-shadow: 0 0 0 0.2rem rgba(0, 136, 221, 0.25);
}
.switch input:disabled + label {
  color: #868e96;
  cursor: not-allowed;
}
.switch input:disabled + label::before {
  background-color: #e9ecef;
}
.switch.switch-sm {
  font-size: 0.875rem;
}
.switch.switch-sm input + label {
  min-width: calc(calc(1.9375rem * .8) * 2);
  height: calc(1.9375rem * .8);
  line-height: calc(1.9375rem * .8);
  text-indent: calc(calc(calc(1.9375rem * .8) * 2) + .5rem);
}
.switch.switch-sm input + label::before {
  width: calc(calc(1.9375rem * .8) * 2);
}
.switch.switch-sm input + label::after {
  width: calc(calc(1.9375rem * .8) - calc(2px * 2));
  height: calc(calc(1.9375rem * .8) - calc(2px * 2));
}
.switch.switch-sm input:checked + label::after {
  margin-left: calc(1.9375rem * .8);
}
.switch.switch-lg {
  font-size: 1.25rem;
}
.switch.switch-lg input + label {
  min-width: calc(calc(3rem * .8) * 2);
  height: calc(3rem * .8);
  line-height: calc(3rem * .8);
  text-indent: calc(calc(calc(3rem * .8) * 2) + .5rem);
}
.switch.switch-lg input + label::before {
  width: calc(calc(3rem * .8) * 2);
}
.switch.switch-lg input + label::after {
  width: calc(calc(3rem * .8) - calc(2px * 2));
  height: calc(calc(3rem * .8) - calc(2px * 2));
}
.switch.switch-lg input:checked + label::after {
  margin-left: calc(3rem * .8);
}
.switch + .switch {
  margin-left: 1rem;
}

.pricing{
    width: 100%;
    margin: 0 auto;
    overflow: hidden;
    padding: 10px 0;
    align-items: center;
    justify-content: space-around;
    display: flex;
    float: none;
}
    </style>
@endpush