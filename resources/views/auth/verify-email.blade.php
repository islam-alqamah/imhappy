@extends('layouts.point-layout')

@section('content')


    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default card-view">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                               <center> <lottie-player
                                        src="https://assets7.lottiefiles.com/packages/lf20_avhcook6.json"
                                        style="width: 175px;"
                                        autoplay
                                        loop
                                ></lottie-player>
                                <h4 style="color: #15E2BE;text-align: center" class="mt-10"> {{ __('Thanks for signing up!') }}</h4>
                                <p style="color: #9FBB95;text-align: center" class="mt-10">
                                    {{ __('We now need to verify your email address, we\'ve sent an email to').'<span style="color:#15e2be">'. auth()->user()->email.'</span>' .__('to verify your address. Please click the link in the email to continue.') }}
                                </p>
                                @if (session('status') == 'verification-link-sent')
                                    <div class="alert alert-success" role="alert">
                                        {{ __('A new verification link has been sent. ') }}
                                    </div>
                                @endif

                                <form method="POST" action="/email/verification-notification">
                                    @csrf

                                    <div>
                                        <button type="submit"  class="btn btn-primary fancy-button btn-0 mt-20 mr-20 btn-outline">
                                            {{ __('Resend Verification Email') }}
                                        </button>
                                    </div>
                                </form>
                                <form method="POST" action="/logout">
                                    @csrf

                                    <button type="submit" class="btn btn-info fancy-button btn-0 mt-20 btn-outline">
                                        {{ __('Logout') }}
                                    </button>
                                </form>
                               </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
