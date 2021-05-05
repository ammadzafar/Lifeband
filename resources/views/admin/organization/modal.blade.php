<!--************************************
			Modal Start
	*************************************-->
    @if(!empty($organization))
      <form name="myForm" class="at-modalform at-formtheme" action="{{route('organization.update',['id'=>$organization->id])}}" method="post" enctype="multipart/form-data">
         @csrf
         @method('PUT')
    @else
      <form name="myForm" class="at-modalform at-formtheme" action="{{route('organization.store')}}" method="post" enctype="multipart/form-data">
         @csrf
    @endif
    <fieldset>
        <div class="at-uploadimg">
            <div class="form-group">
                <input type="file" name="image" id="at-uploadlogo">
                <label id="at-dropyourlogo" for="at-uploadlogo">
                    @if(!empty($organization->image))
                        <img class="org-image" style="display: block" src="{{isset($organization)? asset('uploads/organization/logos/'.$organization->image):''}}" alt="">
                    @else
                    <i class="icon-upload"></i>
                        <img class="org-image" src="{{isset($organization)? asset('uploads/organization/logos/'.$organization->image):''}}" alt="">
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
                <label>Organization Name</label>
                <input type="text" name="name" class="org-name" placeholder="Yale Ltd" value="{{isset($organization)? $organization->name : ''}}">
                <div class="name-error at-error"> </div>
{{--                @error('name')--}}
{{--                <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                @enderror--}}
            </div>
            <div class="form-group">
                <label>Category</label>
                <input type="text" name="category" class="org-category" placeholder="Sports" value="{{isset($organization)? $organization->category : ''}}">
                <div class="category-error at-error"> </div>
{{--                @error('category')--}}
{{--                <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                @enderror--}}
            </div>
            <div class="form-group">
                <label>Email ID</label>
                <input type="email" name="email" class="org-email" placeholder="abcd@gmail.com" value="{{isset($organization)? $organization->email : ''}}">
                <div class="email-error at-error"> </div>
{{--                @error('email')--}}
{{--                <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                @enderror--}}
            </div>
            <div class="form-group">
                <label>No. of bands</label>
                <input type="text" name="bands" class="org-band" placeholder="30" value="{{isset($organization)? $organization->bands: ''}}">
                <div class="band-error at-error"> </div>
{{--                @error('bands')--}}
{{--                <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                @enderror--}}
            </div>
            <div class="form-group">
                <label>Organization Admin</label>
                <input class="org-admin" type="text" name="admin_name" placeholder="Organization Admin" value="{{isset($organization)? $organization->admin_name : auth()->user()->name}}">
                <div class="admin-error at-error"> </div>
{{--                @error('admin_name')--}}
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
