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
        Loader
*************************************-->
<div id="status" data-id="test" class="d-none">
    <div id="preloader" class="preloader">
        <div class="lds-roller">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>
<!--************************************
        Wrapper Starts
*************************************-->
<div class="at-wrapper">
    <!--************************************
            Header Start
    *************************************-->
   @include('includes.admin.header')

    <!--************************************
            Header End
    *************************************-->

    <!--************************************
            Main Start
    *************************************-->
    @yield('content')
    <!--************************************
            Main End
    *************************************-->
</div>
<!--************************************
        Wrapper End
*************************************-->
@include('includes.admin.script')
@yield('scripts')

</body>
</html>
