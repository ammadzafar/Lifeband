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
                    <h3>change password</h3>
                </div>
                <div class="at-settingformholder">
                    <form class="at-formtheme" id="password_form" data-id="{{auth()->user()->id}}">
                        <fieldset>
                            <div class="form-group">
                                <label>current password</label>
                                <input class="old-password" type="password" name="password">
                                <div class="password-error at-error"> </div>
                            </div>
                            <div class="form-group">
                                <label>new password</label>
                                <input class="new-password" type="password" name="new-password">
                                <div class="password-error at-error2"> </div>
                            </div>
                            <div class="form-group">
                                <label>confirm password</label>
                                <input class="confirm-password" type="password" name="confirm-password">
                                <div class="password-error at-error3"> </div>
                            </div>
                            <button type="submit" class="at-btn at-bggreen">update password</button>
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
            $(document).on('submit','#password_form',function (e){
                e.preventDefault();

                if ($('.old-password').val() == ''){
                    $('.at-error').text('**'+'Please provide your old password');
                }else if($('.new-password').val() == ''){
                    $('.at-error2').text('**'+'Please provide your new password');
                    $('.at-error').hide();
                }else if($('.confirm-password').val() == ''){
                    $('.at-error3').text('**'+'Confirm password is required');
                    $('.at-error').hide();
                    $('.at-error2').hide();
                }else if($('.confirm-password').val() != $('.new-password').val()){
                    $('.at-error3').text('**'+'Password does not match with new password');
                } else{
                        let data = {
                            '_token': '{{csrf_token()}}',
                            'id': $(this).data('id'),
                            'old_password' : $('.old-password').val(),
                            'new_password' : $('.new-password').val(),
                        };
                        $.post('/profile/change-password/',data,function (response) {
                            if(response.status == 'error'){
                                $('.at-error').text('**'+response.message);
                            }
                                window.location = '{{route('logout')}}'
                        })
                    }
            });
        });
    </script>
@endsection


