@extends('layouts.auth')
@section('title','Life Band Login')
@section('content')

        <!--************************************
                Login page Start
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
                <form class="at-formtheme at-loginform" method="POST" action="{{ route('login') }}">
                    @csrf
                    <fieldset>
                        <legend>
                            <span>Welcome Back</span>, Please login to your account.
                        </legend>
                        <div class="form-group">
                            <input type="email" class="@error('email') is-invalid @enderror" name="email" placeholder="Email Address">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="@error('password') is-invalid @enderror" name="password" placeholder="password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="form-group">
{{--                            @if (Route::has('password.request'))--}}
{{--                            <a href="{{ route('password.request') }}" class="at-btnforgot">Forgot Password?</a>--}}
{{--                                @endif--}}
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
                Login page End
        *************************************-->
    <!--************************************
            Wrapper End
    *************************************-->
@endsection




{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Login') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('login') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

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
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                    <label class="form-check-label" for="remember">--}}
{{--                                        {{ __('Remember Me') }}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-8 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Login') }}--}}
{{--                                </button>--}}

{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                        {{ __('Forgot Your Password?') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}
