@extends('default.layouts.index')

@section('content')
    <div class="log-in pt-30 pb-100 ptb-sm-60">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="well mb-sm-30">
                        <div class="new-customer">
                            <h3 class="custom-title">{{ __('Verify Your Email Address') }}</h3>
                            <div class="pt-15"></div>
                            @if (session('resent'))
                                <div class="alert alert-success pt-10" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif
                            <p>
                                {{ __('Before proceeding, please check your email for a verification link.') }}
                                {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
