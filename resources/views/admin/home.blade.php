@extends('layouts.admin')
@section('title','Life Band Dashboard')
@section('content')
    <main id="at-main" class="at-main at-haslayout">
        <div class="at-dashboard">
            <div class="at-content">
                <div class="at-dashboardcontent">
                    <div class="at-alert">
                        <figure class="at-alertimg">
                            <img src="{{asset('asset/images/alert.png')}}" alt="">
                        </figure>
                        <div class="at-alercontent">
                            <h2>Hi {{auth()->user()->name}}</h2>
                            <div class="at-description">
                                <p>Welcome back {{auth()->user()->name}}. We are glad you are here. Monitor all the health activities and social distancing breaches.</p>
                            </div>
                        </div>
                    </div>
                    <div class="at-pagetitle">
                        <h2>You want to access</h2>
                    </div>
                  @if(auth()->user()->isAdmin())
                    <div class="at-accountaccess">
                        <div class="at-account">
                                <a href="{{route('organization.home')}}">
                                <div class="at-accounttitle">
                                    <h3>Organizations</h3>
                                </div>
                                <figure class="at-accountimg">
                                    <img src="{{asset('asset/images/organization.png')}}" alt="accoun image">
                                </figure>
                            </a>
                        </div>
                        <div class="at-account">
                            <a href="{{route('family.accounts.home')}}">
                                <div class="at-accounttitle">
                                    <h3>Family Accounts</h3>
                                </div>
                                <figure class="at-accountimg">
                                    <img src="{{asset('asset/images/familyaccount.png')}}" alt="account image">
                                </figure>
                            </a>
                        </div>
                        <div class="at-account">
                            <a href="{{route('individual.account.dashboard')}}">
                                <div class="at-accounttitle at-aindividualtitle">
                                    <h3>Individual Accounts</h3>
                                </div>
                                <figure class="at-accountimg">
                                    <img src="{{asset('asset/images/individual.png')}}" alt="account image">
                                </figure>
                            </a>
                        </div>
                    </div>
                  @elseif(auth()->user()->isOrganizer())
                        <div class="at-accountaccess">
                            <div class="at-account">
                                <a href="{{route('organization.admin.home')}}">
                                    <div class="at-accounttitle">
                                        <h3>Organizations</h3>
                                    </div>
                                    <figure class="at-accountimg">
                                        <img src="{{asset('asset/images/organization.png')}}" alt="account image">
                                    </figure>
                                </a>
                            </div>
                        </div>
                  @elseif(auth()->user()->isFamilyAccountant())
                        <div class="at-accountaccess">
                            <div class="at-account">
                                <a href="familyaccount.html">
                                    <div class="at-accounttitle">
                                        <h3>Family Accounts</h3>
                                    </div>
                                    <figure class="at-accountimg">
                                        <img src="{{asset('asset/images/familyaccount.png')}}" alt="account image">
                                    </figure>
                                </a>
                            </div>
                        </div>
                    @elseif(auth()->user()->isIndividualAccountant())
                        <div class="at-accountaccess">
                            <div class="at-account">
                                <a href="dashboardvtwo.html">
                                    <div class="at-accounttitle at-aindividualtitle">
                                        <h3>Individual Accounts</h3>
                                    </div>
                                    <figure class="at-accountimg">
                                        <img src="{{asset('asset/images/individual.png')}}" alt="account image">
                                    </figure>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
    @endsection
