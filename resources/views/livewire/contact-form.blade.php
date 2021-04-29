<div class="container space-2 space-lg-3">
    <!-- Title -->
    <div class="mb-5 text-center w-md-80 w-lg-50 mx-md-auto mb-md-9">
        <h2>{{ __('Tell us about yourself or your business') }}</h2>
        <p>{{ __('Whether you have questions or you would just like to say hello, contact us.') }}</p>
    </div>
    <!-- End Title -->

    <div class="mx-auto w-lg-80">
        <!-- Contacts Form -->
        <form wire:submit.prevent="contactFormSubmit" action="/contact" method="POST" class="w-full">
            @csrf
            <div class="row">
                <!-- Input -->
                <div class="mb-4 col-sm-6">
                    <div class="js-form-message">
                        <label class="input-label">{{ __('Your name') }}</label>
                        <input type="text" wire:model="name" class="form-control contact-input white-input" name="name" placeholder="Jeff Fisher"
                            aria-label="Jeff Fisher" required="" data-msg="Please enter your name.">
                    </div>
                    @error('email')
                        <p class="mt-1 text-red">{{ $message }}</p>
                    @enderror
                </div>
                <!-- End Input -->

                <!-- Input -->
                <div class="mb-4 col-sm-6">
                    <div class="js-form-message">
                        <label class="input-label">{{ __('Your email address') }}</label>
                        <input type="email" wire:model="email" class="form-control contact-input white-input" name="email" placeholder="jackwayley@gmail.com"
                            aria-label="jackwayley@gmail.com" required=""
                            data-msg="Please enter a valid email address.">
                    </div>
                </div>
                <!-- End Input -->

                <div class="w-100"></div>

                <!-- Input -->
                <div class="mb-4 col-sm-6">
                    <div class="js-form-message">
                        <label class="input-label">{{ __('Subject') }}</label>
                        <input type="text" wire:model="subject" class="form-control contact-input white-input" name="subject" placeholder="Web design"
                            aria-label="Web design" required="" data-msg="Please enter a subject.">
                    </div>
                </div>
                <!-- End Input -->

                <!-- Input -->
                <div class="mb-4 col-sm-6">
                    <div class="js-form-message">
                        <label class="input-label">{{ __('Your phone number') }}</label>
                        <input type="number" wire:model="phone" class="contact-input white-input form-control" name="phone" placeholder="1-800-643-4500"
                            aria-label="1-800-643-4500" required="" data-msg="Please enter a valid phone number.">
                    </div>
                </div>
                <!-- End Input -->
            </div>

            <!-- Input -->
            <div class="mb-6 js-form-message">
                <label class="input-label">{{ __('How can we help you?') }}</label>
                <div class="input-group">
                    <textarea class="form-control contact-input white-input" wire:model="comment" rows="4" name="text" placeholder="Hi there, I would like to ..."
                        aria-label="Hi there, I would like to ..." required=""
                        data-msg="Please enter a reason."></textarea>
                </div>
            </div>
            <!-- End Input -->

            <div class="text-center">
                <button type="submit" class="mt-2 btn btn-primary contact-submit">{{ __('Submit') }}</button>
            </div>
        </form>
        <!-- End Contacts Form -->
    </div>
</div>
