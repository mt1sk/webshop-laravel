@extends('default.layouts.index')

@section('content')
    <div class="log-in pt-30 pb-100 ptb-sm-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="well mb-sm-30">
                        <div class="new-customer">
                            <h3 class="custom-title">{{ __('Reset Password') }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="well">
                        <div class="return-customer">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4" style="margin-top: -20px;">
                                        <input type="submit" value="{{ __('Send Password Reset Link') }}" class="return-customer-btn">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
