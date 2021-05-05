@extends('layouts.users')
@section('title','Life Band Index')
@section('content')

    <!--************************************
            banner Start
    *************************************-->
    <div class="at-banner">
        <div class="at-bannercontentholde">
            <h1>Your Safety <span>with wearables</span></h1>
            <span>Life Band is the most advanced wearable for your healthy future.</span>
            <div class="at-downloadnow">
                <span>Find us on</span>
                <ul>
                    <li>
                        <a href="javascript: void(0);">
                            <img src="{{asset('asset/images/landingpage-images/appstore.png')}}" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="javascript: void(0);">
                            <img src="{{asset('asset/images/landingpage-images/playstore.png')}}" alt="">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="at-bannerimagearea">
            <figure>
                <img src="{{asset('asset/images/landingpage-images/bannerimg.png')}}" alt="banner image">
            </figure>
        </div>
        <a id="at-btnscroll" href="javascript: void(0);" class="at-btnscrollicon">
            <i class="icon-scrollicon"></i>
        </a>
    </div>
    <!--************************************
            banner  End
    *************************************-->
    <main class="at-main">
        <!--************************************
                The Life Band Start
        *************************************-->
        <div id="at-lifeband" class="at-haslayout at-sectionspace at-bglifeband">
            <div class="at-container">
                <div class="at-lifeband">
                    <div class="at-sectionhead">
                        <div class="at-sectiontitle">
                            <h3>Reasons to Choose</h3>
                            <h2>THE LIFE BAND </h2>
                        </div>
                        <div class="at-description">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                    <div class="at-lifebandcontentholder">
                        <div class="at-lifebandcontent">
                            <figure>
                                <img src="{{asset('asset/images/landingpage-images/social-distancing.png')}}" alt="social distance image">
                            </figure>
                            <div class="at-lifebandtitle">
                                <h4>Social Distancing</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur</p>
                            </div>
                        </div>
                        <div class="at-lifebandcontent">
                            <figure>
                                <img src="{{asset('asset/images/landingpage-images/heart-beat.png')}}" alt="heart-beat image">
                            </figure>
                            <div class="at-lifebandtitle">
                                <h4>Vitals Monitoring</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur</p>
                            </div>
                        </div>
                        <div class="at-lifebandcontent">
                            <figure>
                                <img src="{{asset('asset/images/landingpage-images/image-05.png')}}" alt="image">
                            </figure>
                            <div class="at-lifebandtitle">
                                <h4>Your Fitness Partner</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--************************************
                The Life BandEnd
        *************************************-->
        <!--************************************
                Use Case
        *************************************-->
        <div class="at-haslayout">
            <div class="at-usecase">
                <div class="at-sectionhead">
                    <div class="at-sectiontitle">
                        <h3>Your Healthy Partner</h3>
                        <h2>USE CASES</h2>
                    </div>
                    <div class="at-description">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="at-usecasecontentholder">
                    <figure class="at-usecaseholderimg">
                        <img src="{{asset('asset/images/landingpage-images/usecase.png')}}" alt="use case image">
                    </figure>
                    <div class="at-usecasearea">
                        <div id="at-cursoleslider" class="owl-carousel owl-theme at-owlcursoleslider">
                           <div class="item">
                               <figure class="at-usecaseimg">
                                   <img src="{{asset('asset/images/landingpage-images/Hotels.png')}}" alt="usecase image">
                                   <figcaption>
                                       <div class="at-usecasecontent">
                                           <h3>For hotels</h3>
                                           <div class="at-description">
                                               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ut labore et dolore magna aliqua. sed do eiusmod tempor incididunt ut labore et.</p>
                                           </div>
                                       </div>
                                   </figcaption>
                               </figure>
                           </div>
                            <div class="item">
                                <figure class="at-usecaseimg">
                                    <img src="{{asset('asset/images/landingpage-images/Nursing home.png')}}" alt="usecase image">
                                    <figcaption>
                                        <div class="at-usecasecontent">
                                            <h3>For Nursing Homes</h3>
                                            <div class="at-description">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ut labore et dolore magna aliqua. sed do eiusmod tempor incididunt ut labore et.</p>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                            <div class="item">
                                <figure class="at-usecaseimg">
                                    <img src="{{asset('asset/images/landingpage-images/Park.png')}}" alt="usecase image">
                                    <figcaption>
                                        <div class="at-usecasecontent">
                                            <h3>For Individuals</h3>
                                            <div class="at-description">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ut labore et dolore magna aliqua. sed do eiusmod tempor incididunt ut labore et.</p>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                            <div class="item">
                                <figure class="at-usecaseimg">
                                    <img src="{{asset('asset/images/landingpage-images/Gym.png')}}" alt="usecase image">
                                    <figcaption>
                                        <div class="at-usecasecontent">
                                            <h3>For GYM Owners</h3>
                                            <div class="at-description">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ut labore et dolore magna aliqua. sed do eiusmod tempor incididunt ut labore et.</p>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                            <div class="item">
                                <figure class="at-usecaseimg">
                                    <img src="{{asset('asset/images/landingpage-images/Office.png')}}" alt="usecase image">
                                    <figcaption>
                                        <div class="at-usecasecontent">
                                            <h3>For Offices</h3>
                                            <div class="at-description">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ut labore et dolore magna aliqua. sed do eiusmod tempor incididunt ut labore et.</p>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                            <div class="item">
                                <figure class="at-usecaseimg">
                                    <img src="{{asset('asset/images/landingpage-images/Home.png')}}" alt="usecase image">
                                    <figcaption>
                                        <div class="at-usecasecontent">
                                            <h3>For Families</h3>
                                            <div class="at-description">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ut labore et dolore magna aliqua. sed do eiusmod tempor incididunt ut labore et.</p>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    </div>
{{--                    <div class="at-paginationarow">--}}
{{--                        <a href="javascript: void(0);" class="at-btniconleftarow">--}}
{{--                            <i class="icon-leftarow"></i>--}}
{{--                        </a>--}}
{{--                        <a href="javascript: void(0);" class="at-btniconrightarow">--}}
{{--                            <i class="icon-rightarow1"></i>--}}
{{--                        </a>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
        <!--************************************
                Use Case
        *************************************-->
        <!--************************************
                Subscribe Today
        *************************************-->
        <div class="at-haslayout at-sectionspace at-bgsubtoday">
            <div class="at-scuscribetoday">
                <div class="at-sectionhead">
                    <div class="at-sectiontitle">
                        <h3>Pricing</h3>
                        <h2>SUBSCRIBE TODAY</h2>
                    </div>
                    <div class="at-description">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="at-subtodayholder">
                    <ul class="nav nav-tabs at-subscrbietabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Billed Monthly</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Billed Annually</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Price/Device</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="at-billedyearlyholder">
                                <div class="at-billedholder at-billedaindividua">
                                    <div class="at-billedtitle">
                                        <h3>Individual plan</h3>
                                    </div>
                                    <div class="at-billedprice">
                                        <h2><span>$</span>23.99<em>/year</em></h2>
                                        <span>save 76%</span>
                                    </div>
                                    <ul class="at-billedlist">
                                        <li>
                                            <span>Vitals monitoring</span>
                                        </li>
                                        <li>
                                            <span>Fitness friendly</span>
                                        </li>
                                        <li>
                                            <span>Vitals alert</span>
                                        </li>
                                        <li>
                                            <span>Social distancing alerts</span>
                                        </li>
                                        <li>
                                            <span>Fitness measures</span>
                                        </li>
                                        <li>
                                            <span>Health monitor</span>
                                        </li>
                                        <li>
                                            <span>COVID alerts</span>
                                        </li>
                                        <li>
                                            <span>Real time vitals measuring</span>
                                        </li>
                                    </ul>
                                    <div class="at-btngetstartedholder">
                                        <a href="javascript: void(0);" class="at-btn at-btngetstarted">Get Started</a>
                                    </div>
                                </div>
                                <div class="at-billedholder at-billedfamily">
                                    <div class="at-billedtitle">
                                        <h3>FAMILY PLAN</h3>
                                        <span>Upto 6 users</span>
                                    </div>
                                    <div class="at-billedprice">
                                        <h2><span>$</span>23.99<em>/year/user</em></h2>
                                        <span>save 76%</span>
                                    </div>
                                    <ul class="at-billedlist">
                                        <li>
                                            <span>Vitals monitoring</span>
                                        </li>
                                        <li>
                                            <span>Fitness friendly</span>
                                        </li>
                                        <li>
                                            <span>Vitals alert</span>
                                        </li>
                                        <li>
                                            <span>Social distancing alerts</span>
                                        </li>
                                        <li>
                                            <span>Fitness measures</span>
                                        </li>
                                        <li>
                                            <span>Health monitor</span>
                                        </li>
                                        <li>
                                            <span>Family stats monitoring</span>
                                        </li>
                                        <li>
                                            <span>COVID alerts</span>
                                        </li>
                                        <li>
                                            <span>Real time vitals measuring</span>
                                        </li>
                                    </ul>
                                    <div class="at-btngetstartedholder">
                                        <a href="javascript: void(0);" class="at-btn at-btngetstarted">Get Started</a>
                                    </div>
                                </div>
                                <div class="at-billedholder at-billedcorporate">
                                    <div class="at-billedtitle">
                                        <h3>CORPORATE PLAN</h3>
                                    </div>
                                    <div class="at-billedprice">
                                        <h2><span>$</span>23.99<em>/year/employee</em></h2>
                                        <span>save 76%</span>
                                    </div>
                                    <ul class="at-billedlist">
                                        <li>
                                            <span>Vitals monitoring</span>
                                        </li>
                                        <li>
                                            <span>Fitness friendly</span>
                                        </li>
                                        <li>
                                            <span>Vitals alert</span>
                                        </li>
                                        <li>
                                            <span>Social distancing alerts</span>
                                        </li>
                                        <li>
                                            <span>Fitness measures</span>
                                        </li>
                                        <li>
                                            <span>Health monitor</span>
                                        </li>
                                        <li>
                                            <span>Employee stats monitoring</span>
                                        </li>
                                        <li>
                                            <span>COVID alerts</span>
                                        </li>
                                        <li>
                                            <span>Real time vitals measuring</span>
                                        </li>
                                    </ul>
                                    <span class="at-customprice">Custom pricing available for larger corporations.</span>
                                    <div class="at-btngetstartedholder">
                                        <a href="javascript: void(0);" class="at-btn at-btngetstarted">Get Started</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="at-billedyearlyholder">
                                <div class="at-billedholder at-billedaindividua">
                                    <div class="at-billedtitle">
                                        <h3>Individual plan</h3>
                                    </div>
                                    <div class="at-billedprice">
                                        <h2><span>$</span>23.99<em>/year</em></h2>
                                        <span>save 76%</span>
                                    </div>
                                    <ul class="at-billedlist">
                                        <li>
                                            <span>Vitals monitoring</span>
                                        </li>
                                        <li>
                                            <span>Fitness friendly</span>
                                        </li>
                                        <li>
                                            <span>Vitals alert</span>
                                        </li>
                                        <li>
                                            <span>Social distancing alerts</span>
                                        </li>
                                        <li>
                                            <span>Fitness measures</span>
                                        </li>
                                        <li>
                                            <span>Health monitor</span>
                                        </li>
                                        <li>
                                            <span>COVID alerts</span>
                                        </li>
                                        <li>
                                            <span>Real time vitals measuring</span>
                                        </li>
                                    </ul>
                                    <div class="at-btngetstartedholder">
                                        <a href="javascript: void(0);" class="at-btn at-btngetstarted">Get Started</a>
                                    </div>
                                </div>
                                <div class="at-billedholder at-billedfamily">
                                    <div class="at-billedtitle">
                                        <h3>FAMILY PLAN</h3>
                                        <span>Upto 6 users</span>
                                    </div>
                                    <div class="at-billedprice">
                                        <h2><span>$</span>23.99<em>/year/user</em></h2>
                                        <span>save 76%</span>
                                    </div>
                                    <ul class="at-billedlist">
                                        <li>
                                            <span>Vitals monitoring</span>
                                        </li>
                                        <li>
                                            <span>Fitness friendly</span>
                                        </li>
                                        <li>
                                            <span>Vitals alert</span>
                                        </li>
                                        <li>
                                            <span>Social distancing alerts</span>
                                        </li>
                                        <li>
                                            <span>Fitness measures</span>
                                        </li>
                                        <li>
                                            <span>Health monitor</span>
                                        </li>
                                        <li>
                                            <span>Family stats monitoring</span>
                                        </li>
                                        <li>
                                            <span>COVID alerts</span>
                                        </li>
                                        <li>
                                            <span>Real time vitals measuring</span>
                                        </li>
                                    </ul>
                                    <div class="at-btngetstartedholder">
                                        <a href="javascript: void(0);" class="at-btn at-btngetstarted">Get Started</a>
                                    </div>
                                </div>
                                <div class="at-billedholder at-billedcorporate">
                                    <div class="at-billedtitle">
                                        <h3>CORPORATE PLAN</h3>
                                    </div>
                                    <div class="at-billedprice">
                                        <h2><span>$</span>23.99<em>/year/employee</em></h2>
                                        <span>save 76%</span>
                                    </div>
                                    <ul class="at-billedlist">
                                        <li>
                                            <span>Vitals monitoring</span>
                                        </li>
                                        <li>
                                            <span>Fitness friendly</span>
                                        </li>
                                        <li>
                                            <span>Vitals alert</span>
                                        </li>
                                        <li>
                                            <span>Social distancing alerts</span>
                                        </li>
                                        <li>
                                            <span>Fitness measures</span>
                                        </li>
                                        <li>
                                            <span>Health monitor</span>
                                        </li>
                                        <li>
                                            <span>Employee stats monitoring</span>
                                        </li>
                                        <li>
                                            <span>COVID alerts</span>
                                        </li>
                                        <li>
                                            <span>Real time vitals measuring</span>
                                        </li>
                                    </ul>
                                    <span class="at-customprice">Custom pricing available for larger corporations.</span>
                                    <div class="at-btngetstartedholder">
                                        <a href="javascript: void(0);" class="at-btn at-btngetstarted">Get Started</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="at-pricedeviceholder">
                                <div class="at-billedholder at-billedfamily">
                                    <div class="at-billedtitle">
                                        <h3>LIFEBAND</h3>
                                        <span>With 2 Apps</span>
                                    </div>
                                    <div class="at-billedprice">
                                        <h2><span>$</span>50<em>/band</em></h2>
                                    </div>
                                    <div class="at-pricedevicetitle">
                                        <h4>APPLICATIONS</h4>
                                    </div>
                                    <ul class="at-lifebandapps">
                                        <li>
                                            <span>-Wearfit 2.0 app</span>
                                        </li>
                                        <li>
                                            <span>-Lifeband app</span>
                                        </li>
                                    </ul>
                                    <div class="at-pricedevicetitle">
                                        <h4>FEATURES</h4>
                                    </div>
                                    <ul class="at-billedlist">
                                        <li>
                                            <span>Vitals monitoring</span>
                                        </li>
                                        <li>
                                            <span>Fitness friendly</span>
                                        </li>
                                        <li>
                                            <span>Vitals alert</span>
                                        </li>
                                        <li>
                                            <span>Social distancing alerts</span>
                                        </li>
                                        <li>
                                            <span>Fitness measures</span>
                                        </li>
                                        <li>
                                            <span>Health monitor</span>
                                        </li>
                                    </ul>
                                    <div class="at-btngetstartedholder">
                                        <a href="javascript: void(0);" class="at-btn at-btngetstarted">Get Started</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--************************************
                Subscribe Today
        *************************************-->
    </main>
    @endsection

