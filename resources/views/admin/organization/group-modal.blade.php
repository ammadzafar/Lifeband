
<!--************************************
		   Group Modal Start
	*************************************-->
{{--    {{dd($organization->id)}}--}}
   @if(isset($group))
        <form class="at-modalform at-formtheme at-userinfoform" action="{{route('users.group.update',['id'=>$group->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
   @else
      @if(auth()->user()->isAdmin())
          <form class="at-modalform at-formtheme at-userinfoform" action="{{route('users.group.store')}}" method="post" enctype="multipart/form-data">
      @elseif(auth()->user()->isOrganizer())
          <form class="at-modalform at-formtheme at-userinfoform" action="{{route('organization.admin.users.group.store')}}" method="post" enctype="multipart/form-data">
      @elseif(auth()->user()->isFamilyAccountant())
          <form class="at-modalform at-formtheme at-userinfoform" action="{{route('family.admin.users.group.store')}}" method="post" enctype="multipart/form-data">
      @endif
        @csrf
        @endif
        <fieldset>
            <div class="at-modaltitle">
                <h3>Add Group</h3>
            </div>
            <div class="form-group">
                <label>group name</label>
                <input class="group-name" type="text" name="name" placeholder="John" value="{{isset($group) ? $group->name: ''}}">
                @if(isset($organization))
                   <input type="hidden" name="account_id" value="{{$organization->id}}">
                @elseif(isset($family_account))
                   <input type="hidden" name="account_id" value="{{$family_account->id}}">
                @else
                    <input type="hidden" name="account_id" value="{{isset($group) ? $group->account_id : ''}}">
                @endif
            </div>
            <div class="at-uploadimg">
                <div class="form-group">
                    <input type="file" name="image" id="at-uploadlogo">
                    <label for="at-uploadlogo">
                        @if(!empty($group->image))
                            <img class="group-image" style="display: block;" src="{{isset($group)? asset('uploads/group/'.$group->image):''}}" alt="">
                        @else
                            <i class="icon-upload"></i>
                            <img class="group-image" src="{{isset($group)? asset('uploads/group/'.$group->image): ''}}" alt="">
                        @endif

                        <span>Drop or upload logo</span>
                    </label>
                </div>
            </div>
            <ul class="at-reportusers">
              @if(isset($group))
                @foreach($group_users as $user)
                    <li>
                        <span class="at-checkbox">
                            <input class="checkbox" type="checkbox"  name="user_id[]" value="{{$user->id}}" id="at-usersix {{$user->first_name}}"  {{isset($group)? $user->group_id == $group->id ? 'checked' : '' : ''}}  >
                            <label for="at-usersix {{$user->first_name}}">
                                <figure>
                                    <img src="{{asset('asset/images/user.png')}}" alt="User Image">
                                </figure>
                                <h3>{{$user->first_name}}</h3>
                            </label>
                        </span>
                    </li>
                @endforeach
              @else
                @foreach($users as $user)
                    <li>
                       <span class="at-checkbox">
                          <input class="checkbox" type="checkbox" name="user_id[]" value="{{$user->id}}" id="at-usersix {{$user->first_name}}"  {{isset($group)? $user->group_id == $group->id ? 'checked' : '' : ''}}  >
                          <label for="at-usersix {{$user->first_name}}">
                             <figure>
                                 <img src="{{asset('asset/images/user.png')}}" alt="User Image">
                             </figure>
                                <h3>{{$user->first_name}}</h3>
                          </label>
                        </span>
                    </li>
                @endforeach
               @endif
            </ul>
            <div class="form-group">
                <button type="submit" class="at-btn at-bggreen">submit</button>
            </div>
        </fieldset>
    </form>

