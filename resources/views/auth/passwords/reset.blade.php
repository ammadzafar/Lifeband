@extends('layouts.auth')
@section('title'.'Life Band Login')
@section('content')

    <!--************************************
                Reset Password Start
        *************************************-->

    <div class="at-loginpage">
        <figure class="at-loginpageimg">
            <img src="{{asset('asset/images/login.png')}}" alt="login page image">
        </figure>
        <div class="at-logincontent">
            <strong class="at-logo">
						<span>
							<img src="{{asset('asset/images/loginlogo.png')}}" alt="logo image">
						</span>
            </strong>
            <form class="at-formtheme at-loginform" method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <fieldset>
                    <legend>
                        <span>Welcome Back</span>, Please change your account password.
                    </legend>

                    <div class="form-group">
                        <input type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="confirm-password">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="at-btn at-btn-lg at-btnlogin">Login</button>
                    </div>
                    {{--                        <div class="form-group">--}}
                    {{--                            <p>Don’t have an account? <a href="{{route('register')}}">Sign Up</a> </p>--}}
                    {{--                        </div>--}}
                </fieldset>
            </form>
        </div>
    </div>
    <!--************************************
            Reset Password page End
    *************************************-->
@endsection


{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Reset Password') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('password.update') }}">--}}
{{--                        @csrf--}}

{{--                        <input type="hidden" name="token" value="{{ $token }}">--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Reset Password') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}
