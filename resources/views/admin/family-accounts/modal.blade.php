<!--************************************
			Modal Start
	*************************************-->
{{--{{dd($family_account_data)}}--}}

    @if(!empty($family_account_data))
      <form class="at-modalform at-formtheme" action="{{route('family.accounts.update',['id'=>$family_account_data->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    @else
      <form class="at-modalform at-formtheme" action="{{route('family.accounts.store')}}" method="post" enctype="multipart/form-data">
        @csrf
    @endif
    <fieldset>
        <div class="at-uploadimg">
            <div class="form-group">
                <input type="file" name="image" id="at-uploadlogo">
                <label for="at-uploadlogo">
                    @if(!empty($family_account_data->image))
                        <img class="org-image" style="display: block;" src="{{isset($family_account_data)? asset('uploads/family/images/'.$family_account_data->image):''}}" alt="">
                    @else
                        <i class="icon-upload"></i>
                        <img class="org-image" src="{{isset($family_account_data)? asset('uploads/family/images/'.$family_account_data->image):''}}" alt="">
                    @endif
                    <span>Drop or upload logo</span>
                </label>
                <div class="image-error at-imageerror at-error"> </div>
{{--                @error('image')--}}
{{--                <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                @enderror--}}
            </div>
        </div>
        <div class="at-orgnizanerdetails">
            <div class="form-group">
                <label>Family Admin Name</label>
                <input type="text" class="family-name" name="admin_name" placeholder="Stark Brown" value="{{isset($family_account_data)? $family_account_data->admin_name : ''}}">
                <div class="name-error at-error"> </div>
{{--                @error('admin_name')--}}
{{--                <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                @enderror--}}
            </div>
            <div class="form-group">
                <label>Contact #</label>
                <input type="text" class="contact" name="contact_no" placeholder="+1 56 64466964" value="{{isset($family_account_data)? $family_account_data->contact_no : ''}}">
                <div class="contact-error at-error"> </div>
{{--                @error('contact_no')--}}
{{--                <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                @enderror--}}
            </div>
            <div class="form-group">
                <label>Email ID</label>
                <input type="email" class="fam-email" name="email" placeholder="stark24@abcd.com" value="{{isset($family_account_data)? $family_account_data->email : ''}}">
                <div class="email-error at-error"> </div>
{{--                @error('email')--}}
{{--                <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                @enderror--}}
            </div>
            <div class="form-group">
                <label>No. of bands</label>
                <input type="text" class="fam-bands" name="bands" placeholder="50" value="{{isset($family_account_data)? $family_account_data->bands : ''}}">
                <div class="band-error at-error"> </div>
{{--                @error('bands')--}}
{{--                <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                @enderror--}}
            </div>
            <div class="form-group">
                <label>Emergency Contact Number</label>
                <input type="text" class="emg-contact" name="emergency_contact" placeholder="+1 57 48433994" value="{{isset($family_account_data)? $family_account_data->emergency_contact : ''}}">
                <div class="emergency-contact-error at-error"> </div>
{{--                @error('emergency_contact')--}}
{{--                <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                @enderror--}}
            </div>
            <div class="form-group">
                <button type="submit" class="at-btn at-btnsubmit">submit</button>
            </div>
        </div>
    </fieldset>
</form>

<!--************************************
        Modal End
*************************************-->
