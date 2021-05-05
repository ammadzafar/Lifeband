@extends('layouts.admin')
@section('title'.'Life Band Settings')
@section('content')
    <div class="at-settings">
        <div class="at-content">
            <div class="at-pagetitle">
                <h2>settings</h2>
            </div>
            <div class="at-settingarea">
                <div class="at-settinghead">
                    <h3>edit profile</h3>
                </div>
                <div class="at-settingformholdervtwo">
                    <form class="at-formtheme" action="{{route('admin.settings.update',['id'=>auth()->user()->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <fieldset>
                            <div class="at-editprofileinputholder">
                                <div class="form-group">
                                    <label>First name</label>
                                    <input type="text" name="name" placeholder="Aimal" value="{{auth()->user()->name}}">
                                </div>
                                <button type="submit" class="at-btn at-bggreen">update profile</button>
                            </div>
                            <div class="at-changeprofileimagearea">
                                <figure class="at-seetinguserimg">
                                    @if(auth()->user()->image)
                                        <img src="{{asset('uploads/api/images/'.auth()->user()->image)}}" alt="user image">
                                    @else
                                        <i class="icon-upload"></i>
                                    @endif
                                </figure>
                                <div class="at-changeimage">
                                    <input type="file" name="image" id="fileone">
                                    <label for="fileone">change profile picture</label>
                                </div>
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
        $(document).ready(function (){
            $(document).on('change', '#fileone', function (e) {
                 $('.profile-pic').attr('src', URL.createObjectURL(e.target.files[0]));
            });
        });
    </script>
@endsection


