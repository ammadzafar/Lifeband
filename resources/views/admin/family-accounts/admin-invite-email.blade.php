@extends('layouts.auth')
@section('title'.'Life Band Login')
@section('content')
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
            <form class="at-formtheme at-loginform">
                <fieldset>
                    <legend>
                        <span>Welcome </span>, Please register your account.<br>
                    </legend>
                    <div class="form-group">
                        <div class="at-inputwidthfifty">
                            <input type="text" name="email" value="{{$data}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <a href="user.html" class="at-btn at-bggreen"  data-toggle="modal" data-target="#exampleModalCentervfour" >Proceed</a>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <div class="modal fade at-modaltheme at-userinfomodal" id="exampleModalCentervfour" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="at-modalform at-formtheme at-userinfoform" action="{{route('store.family.invited.admin')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <div class="at-modaltitle">
                                <h3>USER INFORMATION</h3>
                                <span>device id:56444568</span>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" placeholder="John">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="at-inputwidthfifty">
                                    <label>Email</label>
                                    <input type="text" name="email" value="{{$data}}">
                                </div>
                                <div class="at-inputwidthfifty">
                                    <label>Password</label>
                                    <input type="password" name="password" placeholder="">
                                    @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="at-btn at-bggreen">submit</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $(document).on('change','#at-uploadlogo',function(e){
                $('.user-image').attr('src', URL.createObjectURL(e.target.files[0]));
                if ($(this).val() != null){
                    $('.icon-upload').css({'display':'none'});
                    $('.user-image').css({'display':'block'});
                    $('.img-span').css({'display':'none'});
                }
            });
        });
    </script>
@endsection


