<!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    @include('includes.admin.style')
    @yield('styles')
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!--************************************
        Wrapper Start
*************************************-->
<div class="at-wrapper at-nopadding">
    <!--************************************
            landin page Start
    *************************************-->
    <!--************************************
            header Start
    *************************************-->
    <header class="at-header at-landingpageheader">
        <strong class="at-logo">
            <a href="javascript: void(0);">
                <img src="{{asset('asset/images/landingpage-images/footlogo.png')}}" alt="logo">
            </a>
        </strong>
    </header>
    <!--************************************
            header End
    *************************************-->
    @yield('content')
    <!--************************************
            Footer Start
    *************************************-->
    <footer class="at-footer at-haslayout">
        <div class="at-footercontentholder">
            <div class="at-footercontent">
                <strong class="at-footlogo">
							<span>
								<img src="{{asset('asset/images/landingpage-images/footlogo.png')}}" alt="logo">
							</span>
                </strong>
                <div class="at-description">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad </p>
                </div>
                <ul class="at-followus">
                    <li>
                        <span>follow us</span>
                    </li>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="icon-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="icon-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="icon-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="icon-linkdin"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="at-footercontent">
                <h5>contact info</h5>
                <ul class="at-contactuslist">
                    <li>
                        <a href="javascript: void(0);">
                            <i class="icon-map"></i>
                            <span>long beach, CA <span>Seattle, WA</span></span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="icon-phone"></i>
                            <span>+44 141 552 3000</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript: void(0);">
                            <i class="icon-email"></i>
                            <span>info@lifeband.com</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="at-footercontent">
                <div class="at-othercompanylogo">
                    <figure>
                        <img src="{{asset('asset/images/landingpage-images/isologo.png')}}" alt="iso logo">
                    </figure>
                    <figure>
                        <img src="{{asset('asset/images/landingpage-images/ukaslogo.png')}}" alt="ukas logo">
                    </figure>
                </div>
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
        </div>
        <div class="at-copyright">
            <P><span>© 2020 </span> Copy Rights by life band.</P>
        </div>
    </footer>
    <!--************************************
            Footer End
    *************************************-->
    <!--************************************
            Login page End
    *************************************-->
</div>
<!--************************************
        Wrapper End
*************************************-->

@include('includes.admin.script')
@yield('scripts')
</body>
</html>
