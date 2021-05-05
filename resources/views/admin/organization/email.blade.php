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
                            <input type="text" name="email" value="{{$data->email}}">
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
                    <form class="at-modalform at-formtheme at-userinfoform" action="{{route('store.invited.users')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <div class="at-modaltitle">
                                <h3>USER INFORMATION</h3>
                                <span>device id:56444568</span>
                            </div>
                            <div class="form-group">
                                <div class="at-choosefileholder">
                                    <input type="file" name="image" id="at-uploadlogo">
                                    <label id="at-dropyourlogo" for="at-uploadlogo">
                                        <i class="icon-upload"></i>
                                        <span class="img-span">image</span>
                                        <img class="user-image" src="" alt="">
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" placeholder="John">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <input type="hidden" name="account_id" value="{{$data->account_id}}">
                            </div>
                            <div class="form-group">
                                <div class="at-inputwidthfifty">
                                    <label>Email</label>
                                    <input type="text" name="email" value="{{$data->email}}">
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
                                <div class="at-inputwidthfifty">
                                    <label>Weight</label>
                                    <input type="text" name="weight" placeholder="enter your weight">
                                </div>
                                @error('weight')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="at-inputwidthfifty">
                                    <label>Weight Unit</label>
                                    <input type="text" name="weight_unit" placeholder="Inch/Cm">
                                </div>
                                @error('height')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="at-inputwidthfifty">
                                    <label>Height</label>
                                    <input type="text" name="height" placeholder="enter your weight">
                                </div>
                                @error('weight')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="at-inputwidthfifty">
                                    <label>Height Unit</label>
                                    <input type="text" name="height_unit" value="Kg">
                                </div>
                                @error('height')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="at-inputwidthfifty">
                                    <label>gender</label>
                                    <div class="at-radio">
                                        <input type="radio" id="male" name="gender" value="male">
                                        <label for="male">male</label>
                                    </div>
                                    <div class="at-radio">
                                        <input type="radio" id="female" name="gender" value="female">
                                        <label for="female">female</label>
                                    </div>
                                    @error('gender')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="at-inputwidthfifty">
                                    <label>age</label>
                                    <input type="text" name="age" placeholder="enter your age">
                                    @error('age')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="at-inputwidthfifty">
                                    <label>Wear Side</label>
                                    <input type="text" name="wear_side" placeholder="which side you wear band">
                                </div>
                                @error('wear_side')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="at-inputwidthfifty">
                                    <label>Target</label>
                                    <input type="text" name="personal_goal" placeholder="enter your target">
                                </div>
                                @error('personal_goal')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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


