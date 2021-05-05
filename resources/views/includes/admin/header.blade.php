<!--************************************
            Header Start
    *************************************-->
<header id="at-header" class="at-header">
    <strong class="at-logo">
{{--        @if(auth()->user()->isAdmin())--}}
{{--            <a href="{{route('home.index')}}">--}}
{{--        @elseif(auth()->user()->isOrganizer())--}}
{{--             <a href="{{route('organization.index')}}">--}}
{{--        @elseif(auth()->user()->isFamilyAccountant())--}}
{{--             <a href="{{route('family.index')}}">--}}
{{--        @elseif(auth()->user()->isIndividualAccountant())--}}
{{--             <a href="{{route('individual.index')}}">--}}
{{--        @endif--}}

        @if(auth()->user()->isAdmin())
            <a href="{{route('home.index')}}"><img src="{{asset('asset/images/logo.png')}}" alt="logo image"></a>
        @elseif(auth()->user()->isOrganizer())
            <a href="{{route('organization.admin.home')}}"><img src="{{asset('asset/images/logo.png')}}" alt="logo image"></a>
        @elseif(auth()->user()->isFamilyAccountant())
            <a href="{{route('family.admin.home')}}"><img src="{{asset('asset/images/logo.png')}}" alt="logo image"></a>
        @endif
    </strong>
    @php($path = ['superadmin/organization/dashboard/*','superadmin/organization/users/*','superadmin/organization/social-distance/*','superadmin/family-accounts/dashboard/*','superadmin/family-accounts/users/*','superadmin/family-accounts/social-distance/*',
                  'superadmin/group/create/*','superadmin/questionnaire/create/*','superadmin/questionnaire/history/*','admin/organization/dashboard/*','admin/organization/users/*','admin/organization/social-distance/*','admin/group/create/*','family/account/dashboard/*','family/account/users/*','family/account/social-distance/*','family/group/create/*',])
    @php($path2 = ['superadmin/individual-account/dashboard','superadmin/individual-account/users','superadmin/individual-account/social-distance'])
    @if(show_navbar($path))
        <nav class="at-navigation">
            <ul>
               @if(auth()->user()->isAdmin())
                    <li class="{{(request()->segment(3) == 'dashboard' ? 'at-active':'')}}">
                        @if(session('type') == 'family')
                            <a href="{{route('family.accounts.dashboard',$family_account->id)}}">
                                <i class="icon-dashboard "></i>
                                <span>dashboard</span>
                            </a>
                        @elseif(session('type') == 'organization')
                            <a href="{{route('organization.dashboard',$organization->id)}}">
                                <i class="icon-dashboard"></i>
                                <span>dashboard</span>
                            </a>
                        @endif
                    </li>
               @elseif(auth()->user()->isOrganizer())
                    <li class="{{(request()->segment(3) == 'dashboard' ? 'at-active':'')}}">
                        @if(session('type') == 'family')
                            <a href="{{route('family.accounts.dashboard',$family_account->id)}}">
                                <i class="icon-dashboard"></i>
                                <span>dashboard</span>
                            </a>
                        @elseif(session('type') == 'organization')
                            <a href="{{route('organization.admin.dashboard',$organization->id)}}">
                                <i class="icon-dashboard"></i>
                                <span>dashboard</span>
                            </a>
                        @endif
                    </li>
                @elseif(auth()->user()->isFamilyAccountant())
                    <li class="{{(request()->segment(3) == 'dashboard' ? 'at-active':'')}}">
                        @if(session('type') == 'family')
                            <a href="{{route('family.admin.dashboard',$family_account->id)}}">
                                <i class="icon-dashboard"></i>
                                <span>dashboard</span>
                            </a>
                        @elseif(session('type') == 'organization')
                            <a href="{{route('organization.admin.dashboard',$organization->id)}}">
                                <i class="icon-dashboard"></i>
                                <span>dashboard</span>
                            </a>
                        @endif
                    </li>
               @endif
                @if(auth()->user()->isAdmin())
                    <li class="{{(request()->segment(3) == 'users' ? 'at-active':'')}}">
                        @if(session('type') == 'family')
                            <a href=" {{route('family.accounts.users',$family_account->id)}}"> <i class="icon-user"></i>
                                <span>users</span>
                            </a>
                        @elseif(session('type') == 'organization')
                            <a href="{{route('organization.users',$organization->id)}}"> <i class="icon-user"></i>
                                <span>users</span>
                            </a>
                        @endif
                    </li>
                @elseif(auth()->user()->isOrganizer())
                    <li class="{{(request()->segment(3) == 'users' ? 'at-active':'')}}">
                        @if(session('type') == 'family')
                            <a href=" {{route('family.accounts.users',$family_account->id)}}"> <i class="icon-user"></i>
                                <span>users</span>
                            </a>
                        @elseif(session('type') == 'organization')
                            <a href="{{route('admin.organization.users',$organization->id)}}"> <i class="icon-user"></i>
                                <span>users</span>
                            </a>
                        @endif
                    </li>
                   @elseif(auth()->user()->isFamilyAccountant())
                       <li class="{{(request()->segment(3) == 'users' ? 'at-active':'')}}">
                           @if(session('type') == 'family')
                               <a href=" {{route('family.admin.users',$family_account->id)}}"> <i class="icon-user"></i>
                                   <span>users</span>
                               </a>
                           @elseif(session('type') == 'organization')
                               <a href="{{route('admin.organization.users',$organization->id)}}"> <i class="icon-user"></i>
                                   <span>users</span>
                               </a>
                           @endif
                       </li>
                @endif
                @if(auth()->user()->isAdmin())
                    <li class="{{(request()->segment(3) == 'social-distance' ? 'at-active':'')}}">
                        @if(session('type') == 'family')
                            <a href="{{route('family.social.distance',$family_account->id)}}">
                                <i class="icon-socialdestance"></i>
                                <span>social distancing</span>
                            </a>
                        @elseif(session('type') == 'organization')
                            <a href="{{route('organization.social.distance',$organization->id)}}">
                                <i class="icon-socialdestance"></i>
                                <span>social distancing</span>
                            </a>
                        @endif
                    </li>
                @elseif(auth()->user()->isOrganizer())
                       <li class="{{(request()->segment(3) == 'social-distance' ? 'at-active':'')}}">
                           <a href="{{route('organization.admin.social.distance',$organization->id)}}">
                               <i class="icon-socialdestance"></i>
                                  <span>social distancing</span>
                           </a>
                       </li>
                @elseif(auth()->user()->isFamilyAccountant())
                       <li class="{{(request()->segment(3) == 'social-distance' ? 'at-active':'')}}">
                           <a href="{{route('family.admin.social.distance',$family_account->id)}}">
                               <i class="icon-socialdestance"></i>
                               <span>social distancing</span>
                           </a>
                       </li>
                @endif
            </ul>
        </nav>

    @elseif(show_navbar($path2))
        <nav class="at-navigation">
            <ul>
                <li class="{{(request()->segment(3) == 'dashboard' ? 'at-active':'')}}">
                    <a href="{{route('individual.account.dashboard')}}">
                        <i class="icon-dashboard"></i>
                        <span>dashboard</span>
                    </a>
                </li>
                <li class="{{(request()->segment(3) == 'users' ? 'at-active':'')}}">
                    <a href="{{route('individual.account.users')}}">
                        <i class="icon-user"></i>
                        <span>users</span>
                    </a>
                </li>
                <li class="{{(request()->segment(3) == 'social-distance' ? 'at-active':'')}}">
                    <a href="{{route('individual.account.social.distance')}}">
                        <i class="icon-socialdestance"></i>
                        <span>social distancing</span>
                    </a>
                </li>
            </ul>
        </nav>
    @endif

    <div class="at-profilearea">
        <div class="dropdown show at-dropdown">
            <a class="at-btnbellicon" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell"></i>
            </a>
            <div class="dropdown-menu at-notificationdropdown" aria-labelledby="dropdownMenuLink">
                <div class="at-notificationholder">
                    <div class="at-notifications">
                        <div class="at-notification">
                            <a href="javascript: void(0);">
                                <figure>
                                    <img src="{{asset('asset/images/user.png')}}" alt="user image">
                                </figure>
                                <div class="at-notificationcontent">
                                    <h3>Stark Brown</h3>
                                    <div class="at-description">
                                        <p>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.</p>
                                    </div>
                                    <span class="at-questiondate">2nd Feb, 2020 15:24</span>
                                </div>
                            </a>
                        </div>
                        <div class="at-notification">
                            <a href="javascript: void(0);">
                                <figure>
                                    <img src="{{asset('asset/images/user.png')}}" alt="user image">
                                </figure>
                                <div class="at-notificationcontent">
                                    <h3>Stark Brown</h3>
                                    <div class="at-description">
                                        <p>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.</p>
                                    </div>
                                    <span class="at-questiondate">2nd Feb, 2020 15:24</span>
                                </div>
                            </a>
                        </div>
                        <div class="at-notification">
                            <a href="javascript: void(0);">
                                <figure>
                                    <img src="{{asset('asset/images/user.png')}}" alt="user image">
                                </figure>
                                <div class="at-notificationcontent">
                                    <h3>Stark Brown</h3>
                                    <div class="at-description">
                                        <p>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.</p>
                                    </div>
                                    <span class="at-questiondate">2nd Feb, 2020 15:24</span>
                                </div>
                            </a>
                        </div>
                        <div class="at-notification">
                            <a href="javascript: void(0);">
                                <figure>
                                    <img src="{{asset('asset/images/user.png')}}" alt="user image">
                                </figure>
                                <div class="at-notificationcontent">
                                    <h3>Stark Brown</h3>
                                    <div class="at-description">
                                        <p>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.</p>
                                    </div>
                                    <span class="at-questiondate">2nd Feb, 2020 15:24</span>
                                </div>
                            </a>
                        </div>
                        <div class="at-notification">
                            <a href="javascript: void(0);">
                                <figure>
                                    <img src="{{asset('asset/images/user.png')}}" alt="user image">
                                </figure>
                                <div class="at-notificationcontent">
                                    <h3>Stark Brown</h3>
                                    <div class="at-description">
                                        <p>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.</p>
                                    </div>
                                    <span class="at-questiondate">2nd Feb, 2020 15:24</span>
                                </div>
                            </a>
                        </div>
                        <div class="at-notification">
                            <a href="javascript: void(0);">
                                <figure>
                                    <img src="{{asset('asset/images/user.png')}}" alt="user image">
                                </figure>
                                <div class="at-notificationcontent">
                                    <h3>Stark Brown</h3>
                                    <div class="at-description">
                                        <p>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.</p>
                                    </div>
                                    <span class="at-questiondate">2nd Feb, 2020 15:24</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dropdown show at-dropdown">
            <a href="javascript: void(0);" class="at-userdetail" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <figure class="at-userimg">
                    @if(auth()->user()->image)
                       <img src="{{asset('uploads/api/images/'.auth()->user()->image)}}" alt="user image">
                    @else
                       <i class="icon-upload"></i>
                    @endif
                </figure>
                <span>{{auth()->user()->name}}</span>
                <i class="icon-droparow"></i>
            </a>

            <div class="dropdown-menu at-dropdownmenu" aria-labelledby="dropdownMenuLink">
                @if(isset($organization))
                    <a class="dropdown-item" href="{{route('create.questionnaire',['id'=>$organization->id])}}">
                @elseif(isset($family_account))
                    <a class="dropdown-item" href="{{route('create.questionnaire',['id'=>$family_account->id])}}">
                @else
                    <a class="dropdown-item" href="{{route('user.questionnaire',['id'=>auth()->user()->id])}}">
                @endif
{{--                    <i class="icon-questionery"></i>--}}
                    Questionnaire
                </a>
                    <a class="dropdown-item" href="{{route('admin.settings.create',['id'=>auth()->user()->id])}}">
{{--                        <i class="icon-setting"></i>--}}
                        Settings</a>
                <a class="dropdown-item" href="{{route('logout')}}">
{{--                    <i class="icon-logout"></i>--}}
                    Logout
                </a>
            </div>

        </div>
    </div>
</header>
<!--************************************
        Header End
*************************************-->
