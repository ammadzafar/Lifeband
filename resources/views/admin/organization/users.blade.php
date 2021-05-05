@extends('layouts.admin')
@section('title','Life Band Users')
@section('content')
    <!--************************************
				Sidebar Start
		*************************************-->
    <aside class="at-sidebarwrapper">
        <div class="at-sidebartitle">
            <h3>detail</h3>
        </div>
        <div class="user_detail">
{{--              @include('admin.organization.user-detail')--}}
        </div>
    </aside>
    <!--************************************
            Sidebar End
    *************************************-->
    <!--************************************
            Main Start
    *************************************-->
    <main id="at-main" class="at-main at-haslayout">
        <div class="at-dashboard at-users">
            <div class="at-content">
                <div class="at-userscontent">
                    <div class="at-usershead">
                        <div class="at-pagetitle">
                            <h2>users</h2>
                        </div>
                        <div class="at-adduserarea">
                            <ul>
                                <li>
                                    <div class="dropdown at-groupdropdown">
                                        <a class="at-btnaddgroup" href="javascript: void(0);" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="{{asset('asset/images/add-group.svg')}}" alt="user icon">
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalCentervfive">create group</a>
                                            @if(auth()->user()->isAdmin())
                                                <a class="dropdown-item" href="{{route('users.group.create',['id'=>$organization->id])}}">view group</a>
                                            @elseif(auth()->user()->isOrganizer())
                                                <a class="dropdown-item" href="{{route('organization.admin.users.group.create',['id'=>$organization->id])}}">view group</a>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="javascript: void(0);" data-toggle="modal" data-target="#exampleModalCentervthree">
                                        <img src="{{asset('asset/images/filter.svg')}}" alt="filter icon">
                                    </a>
                                </li>
                                <li>
                                    <form class="at-formtheme">
                                        <fieldset>
                                            <div class="form-group at-hideinput">
                                                <a href="javascript: void(0);" class="at-btniconsearch"><i class="icon-search"></i></a>
                                                <input type="text" name="name" value="{{request('name')}}" placeholder="search">
                                            </div>
                                        </fieldset>
                                    </form>
                                </li>
                                <li>
                                    <a href="javascript: void(0);" data-toggle="modal" data-target="#exampleModalCenter">
                                        <i class="icon-add"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="at-usersholder">
                        @if(count($users)>0)
                          @foreach($users as $user)
                            <div class="at-user" data-id="{{$user->id}}">
                            <a href="javascript: void(0);" class="at-sidebarbtn">
                                <div class="at-userhead">
                                    <div class="at-userimage">
                                        <figure>
                                            <img src="{{asset('uploads/users/images/'.$user->image)}}" alt="user image">
                                        </figure>
                                        <div class="at-username">
                                            <h4 class="first-name">{{$user->name}}</h4>
                                            <span>18763369</span>
                                        </div>
                                    </div>
                                    <div class="at-userstatus">
                                        <em>status</em>
                                        <span class="at-bggreentwo">active</span>
                                    </div>
                                </div>
                                <div class="at-userbodydetail">
                                    <ul>
                                        <li>
                                            <i class="icon-heightpm"></i>
                                            <div>
                                                <em>{{is_numeric($user->height) ? $user->height.' inch' : $user->heigth.' cm'}}</em>
                                                <span>height</span>
                                            </div>
                                        </li>
                                        <li>
                                            <i class="icon-weightmeter"></i>
                                            <div>
                                                <em>{{$user->weight}} kg</em>
                                                <span>weight</span>
                                            </div>
                                        </li>
                                        <li>
                                            <i class="icon-target"></i>
                                            <div>
                                                <em>{{$user->personal_goal}}</em>
                                                <span>target</span>
                                            </div>
                                        </li>
                                        <li>
                                            <i class="icon-handwatch"></i>
                                            <div>
                                                <em>{{$user->wear_side}}</em>
                                                <span>hand</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="at-betterywarnings">
{{--                                    <ul class="at-warnings">--}}
{{--                                        <li>--}}
{{--                                            <figure>--}}
{{--                                                <img src="{{asset('asset/images/warningimg.png')}}" alt="warnings image">--}}
{{--                                            </figure>--}}
{{--                                            <span>2 warnings</span>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <figure>--}}
{{--                                                <img src="{{asset('asset/images/warningimg2.png')}}" alt="warnings image">--}}
{{--                                            </figure>--}}
{{--                                            <span>2 warnings</span>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                    <div class="at-betterylevel">--}}
{{--                                        <span>battery level</span>--}}
{{--                                        <figure>--}}
{{--                                            <img src="{{asset('asset/images/Group.svg')}}" alt="bettry img">--}}
{{--                                            <span class="at-charge">--}}
{{--													<span style="width: 75%;"></span>--}}
{{--												</span>--}}
{{--                                        </figure>--}}
{{--                                        <em>75%</em>--}}
{{--                                    </div>--}}
                                </div>
                            </a>
                        </div>
                          @endforeach
                            @else
                            <h5>No User Created Yet</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
{{--    {{dd($user)}}--}}
    <!--************************************
            Main End
    *************************************-->

    <!--************************************
		add member Modal Start
	*************************************-->
    <div class="modal fade at-modaltheme at-creatusermodal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    @if(auth()->user()->isAdmin())
                       <form class="at-modalform at-formtheme" action="{{route('user.store.email')}}" method="post">
                    @elseif(auth()->user()->isOrganizer())
                       <form class="at-modalform at-formtheme" action="{{route('organization.user.store.email')}}" method="post">
                    @endif
                    @csrf
                        <fieldset>
                            <div class="at-modaltitle">
                                <span>tiger aviation</span>
                                <h3>add a member</h3>
                            </div>
                            <div class="at-description">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore gorisns sdlsiowe djjjdows ssakaqi asdse.</p>
                            </div>
                            <div class="form-group">
                                <label>enter email id</label>
                                <div class="at-inputsendinvite">
                                    <input type="text" name="email" placeholder="John.er@systech.com">
                                    <input type="hidden" name="account_id" value="{{$organization->id}}">
                                    <button type="submit" class="at-btn at-bggreen" {{--data-toggle="modal" data-target="#exampleModalCentervtwo"--}}>send invite</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--************************************
          sent invite Modal Start
    *************************************-->
    <div class="modal fade at-modaltheme at-creatusermodal at-sentinvitemodal" id="exampleModalCentervtwo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <figure class="at-sentinviteimage">
                        <img src="{{asset('asset/images/invitsent.png')}}" alt="invite sent image">
                    </figure>
                    <div class="at-sentinvitecontent">
                        <div class="at-modaltitle">
                            <h3>invite sent</h3>
                        </div>
                        <div class="at-description">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore gorisns sdlsiowe djjjdows ssakaqi asdse.</p>
                        </div>
                        <a href="javascritp: void(0);" class="at-btn at-bggreen"  {{--data-toggle="modal" data-target="#exampleModalCentervfour"--}}>continue</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--************************************
         filter	Modal Start
    *************************************-->
    <div class="modal fade at-modaltheme at-choosedisplaymodal" id="exampleModalCentervthree" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="at-modalform at-formtheme" action="{{route('organization.user.filters')}}" method="post">
                        @csrf
                        <fieldset>
                            <div class="at-modaltitle">
                                <h3>Choose what you want to display</h3>
                            </div>
                            <div class="form-group">
                                <em>Sp02</em>
                                <span class="at-checkbox">
									<input type="checkbox" name="oxygen" class="spO2" id="at-checkboxone"  {{ count($users) > 0 ? $users[0]->blood_oxygen_filter == true ? 'checked' : '' : ''}}>
									<label for="at-checkboxone"></label>
								</span>
                            </div>
                            <div class="form-group">
                                <em>Blood Pressure</em>
                                <span class="at-checkbox">
									<input type="checkbox" name="blood_pressure" class="bloodpressure" id="at-checkboxtwo"  {{count($users) > 0 ? $users[0]->blood_pressure_filter == true ? 'checked' : '' : ''}} >
									<label for="at-checkboxtwo"></label>
								</span>
                            </div>
                            <div class="form-group">
                                <em>Heart Rate</em>
                                <span class="at-checkbox">
									<input type="checkbox" name="heart_rate" class="heartrate" id="at-checkboxthree"  {{count($users) > 0 ? $users[0]->heart_rate_filter == true ? 'checked' : '': ''}}>
									<label for="at-checkboxthree"></label>
								</span>
                            </div>
                            <div class="form-group">
                                <em>Fatigue</em>
                                <span class="at-checkbox">
									<input type="checkbox" name="fatigue" class="fatigue" id="at-checkboxfour" {{count($users) > 0 ? $users[0]->fatigue_filter == true ? 'checked' : '': ''}}>
									<label for="at-checkboxfour"></label>
								</span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="at-btn at-bggreen">confirm</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--************************************
         User information Modal Start
    *************************************-->
    <div class="modal fade at-modaltheme at-userinfomodal" id="exampleModalCentervfour" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="at-modalform at-formtheme at-userinfoform">
                        <fieldset>
                            <div class="at-modaltitle">
                                <h3>USER INFORMATION</h3>
                                <span>device id:56444568</span>
                            </div>
                            <div class="form-group">
                                <div class="at-inputwidthfifty">
                                    <label>first name</label>
                                    <input type="text" name="first name" placeholder="John">
                                </div>
                                <div class="at-inputwidthfifty">
                                    <label>last name</label>
                                    <input type="text" name="last name" placeholder="Jacob">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="at-inputwidthfifty">
                                    <label>gender</label>
                                    <div class="at-radio">
                                        <input type="radio" id="male" name="male">
                                        <label for="male">male</label>
                                    </div>
                                    <div class="at-radio">
                                        <input type="radio" id="female" name="male">
                                        <label for="female">female</label>
                                    </div>
                                </div>
                                <div class="at-inputwidthfifty">
                                    <label>phone number</label>
                                    <div class="at-inputwidthselect">
                                        <input type="text" name="last name" placeholder="673 321 56 12">
                                        <div class="dropdown show at-selectcountrydropdown">
                                            <a class="at-brnselectcountry" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <figure>
                                                    <img src="{{asset('asset/images/flag.png')}}" alt="flag img">
                                                </figure>
                                                <span>+1</span>
                                                <i class="icon-droparow"></i>
                                            </a>
                                            <div class="dropdown-menu at-selectcountrymenu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item at-brnselectcountry" href="#">
                                                    <figure>
                                                        <img src="{{asset('asset/images/flag.png')}}" alt="flag img">
                                                    </figure>
                                                    <span>+1</span>
                                                </a>
                                                <a class="dropdown-item at-brnselectcountry" href="#">
                                                    <figure>
                                                        <img src="{{asset('asset/images/flag.png')}}" alt="flag img">
                                                    </figure>
                                                    <span>+1</span>
                                                </a>
                                                <a class="dropdown-item at-brnselectcountry" href="#">
                                                    <figure>
                                                        <img src="{{asset('asset/images/flag.png')}}" alt="flag img">
                                                    </figure>
                                                    <span>+1</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group at-addressform">
                                <label>Street address</label>
                                <input type="text" name="address" placeholder="2 Clinton Rd, Liberty West">
                            </div>
                            <div class="form-group">
                                <div class="at-inputwidthfifty">
                                    <label>city</label>
                                    <input type="text" name="first name" placeholder="New York">
                                </div>
                                <div class="at-inputwidthfifty">
                                    <label>Country/ Region</label>
                                    <input type="text" name="last name" placeholder="United States">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="at-inputwidthfifty">
                                    <label>Emergency Contact Person</label>
                                    <input type="text" name="first name" placeholder="Edward Sheild">
                                </div>
                                <div class="at-inputwidthfifty">
                                    <label>last name</label>
                                    <div class="at-inputwidthselect">
                                        <input type="text" name="last name" placeholder="673 321 56 12">
                                        <div class="dropdown show at-selectcountrydropdown">
                                            <a class="at-brnselectcountry" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <figure>
                                                    <img src="{{asset('asset/images/flag.png')}}" alt="flag img">
                                                </figure>
                                                <span>+1</span>
                                                <i class="icon-droparow"></i>
                                            </a>

                                            <div class="dropdown-menu at-selectcountrymenu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item at-brnselectcountry" href="#">
                                                    <figure>
                                                        <img src="{{asset('asset/images/flag.png')}}" alt="flag img">
                                                    </figure>
                                                    <span>+1</span>
                                                </a>
                                                <a class="dropdown-item at-brnselectcountry" href="#">
                                                    <figure>
                                                        <img src="{{asset('asset/images/flag.png')}}" alt="flag img">
                                                    </figure>
                                                    <span>+1</span>
                                                </a>
                                                <a class="dropdown-item at-brnselectcountry" href="#">
                                                    <figure>
                                                        <img src="{{asset('asset/images/flag.png')}}" alt="flag img">
                                                    </figure>
                                                    <span>+1</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="user.html" class="at-btn at-bggreen">submit</a>
                                <a href="user.html" class="at-btnskip">skip</a>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--************************************
            add group modal End
    *************************************-->
    <div class="modal fade at-modaltheme at-userinfomodal at-addgroupmodal" id="exampleModalCentervfive" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                @if(auth()->user()->isAdmin())
                    <form class="at-modalform at-formtheme at-userinfoform" action="{{route('users.group.store')}}" method="post" enctype="multipart/form-data">
                @elseif(auth()->user()->isOrganizer())
                        <form class="at-modalform at-formtheme at-userinfoform" action="{{route('organization.admin.users.group.store')}}" method="post" enctype="multipart/form-data">
                @endif
                    @csrf
                    <fieldset>
                        <div class="at-modaltitle">
                            <h3>Add Group</h3>
                        </div>
                        <div class="form-group">
                            <label>group name</label>
                            <input class="group-name" type="text" name="name" placeholder="John">
                            <input type="hidden" name="account_id" value="{{$organization->id}}">
                        </div>
                        <div class="at-uploadimg">
                            <div class="form-group">
                                <input type="file" name="image" id="at-uploadlogo">
                                <label for="at-uploadlogo">
                                    <i class="icon-upload"></i>
                                    <img class="group-image" src="" alt="">
                                    <span>Drop or upload logo</span>
                                </label>
                            </div>
                        </div>
                        <ul class="at-reportusers">
                            @php( $group_users = group_users($organization->id))
                            @foreach($group_users as $user)
                                <li>
									<span class="at-checkbox">
										<input type="checkbox" name="user_id[]" value="{{$user->id}}" id="at-usersix {{$user->name}}">
										<label for="at-usersix {{$user->name}}">
											<figure>
												<img src="{{asset('asset/images/user.png')}}" alt="User Image">
											</figure>
											<h3>{{$user->name}}</h3>
										</label>
									</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="form-group">
                            <button type="submit" class="at-btn at-bggreen">submit</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <!--************************************
            Modal End
    *************************************-->
    @endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('change', '#at-uploadlogo', function (e) {
                let image_src = $('.group-image').attr('src', URL.createObjectURL(e.target.files[0]));
                if (image_src != null) {
                    $('.icon-upload').css({'display': 'none'});
                    $('.group-image').css({'display': 'block'});
                }
            });
            $(document).on('click','.at-user',function(e){
                    let id = $(this).data('id');
                    $.get('/organization/user/detail/'+id,function (response) {
                        $('.user_detail').html(response)
                    })
            });
            $(document).on('click','#at-checkboxfive', function (e) {
                let value = '';
                if ($(this).is(':checked')){
                     value = 1;
                }else {
                     value = 0;
                }
                let data = {
                    '_token': '{{csrf_token()}}',
                    'id': $(this).data('id'),
                    'questionnaire_assigned' : value,
                };
                $.post('/assign/questionnaire/',data,function (response) {
                    if(response.status == 'success'){

                    }
                })
            });
        });
    </script>
    @endsection
