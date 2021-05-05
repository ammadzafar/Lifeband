@extends('layouts.auth')
@section('title','Life Band Forget Password')
@section('content')

        <!--************************************
                Login page Start
        *************************************-->
        <div class="at-loginpage at-forgotpage">
            <figure class="at-loginpageimg">
                <img src="{{asset('asset/images/login.png')}}" alt="login page image">
            </figure>
            <div class="at-logincontent">
                <strong class="at-logo">
						<span>
							<img src="{{asset('asset/images/loginlogo.png')}}" alt="logo image">
						</span>
                </strong>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="at-formtheme at-loginform"method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <fieldset>
                        <legend>
                            Forgot Your
                            <span>Password?</span>
                        </legend>
                        <div class="form-group">
                            <p>Enter your email address below and we’ll get you back on track.</p>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" @error('email') is-invalid @enderror placeholder="Email Address">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button href="submit" class="at-btn at-btn-lg at-btnlogin">Reset</button>
                        </div>
                        <div class="form-group">
                            <a class="at-btnbacklogin" href="{{route('login')}}">Back to login</a>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <!--************************************
                Login page End
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
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    <form method="POST" action="{{ route('password.email') }}">--}}
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

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Send Password Reset Link') }}--}}
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
