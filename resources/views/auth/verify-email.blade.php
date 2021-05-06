@extends('layouts.point-layout')

@section('content')


    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default card-view">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <lottie-player
                                        src="https://assets7.lottiefiles.com/packages/lf20_avhcook6.json"
                                        style="width: 100px;"
                                        autoplay
                                        loop
                                ></lottie-player>
                                <h4 style="color: #2DAD00;text-align: center" class="mt-10"> {{ __('Thanks for signing up!') }}</h4>
                                <p style="color: #9FBB95;text-align: center" class="mt-10">
                                    {{ __(' Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                                </p>
                                @if (session('status') == 'verification-link-sent')
                                    <div class="alert alert-success" role="alert">
                                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
