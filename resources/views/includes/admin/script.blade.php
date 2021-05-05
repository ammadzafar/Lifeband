<script src="{{asset('asset/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js')}}"></script>
<script src="{{asset('asset/js/vendor/jquery-library.js')}}"></script>
<script src="{{asset('asset/js/vendor/jquery-migrate.js')}}"></script>
<script src="{{asset('asset/js/vendor/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('asset/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('asset/js/highcharts.js')}}"></script>
{{--<script src="{{asset('asset/js/moment.min.js')}}"></script>--}}
<script src="{{asset('asset/js/rangeslider.js')}}"></script>
<script src="{{asset('asset/js/moment.min.js')}}"></script>
<script src="{{asset('asset/js/daterangepicker.js')}}"></script>
<script src="{{asset('asset/js/themefunction.js')}}"></script>
<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>
    $(document).ready(function (){
        if ("{{\Illuminate\Support\Facades\Session::has('error')}}") {
            swal.fire({
                icon: 'error',
                title: 'error',
                text: '{{\Illuminate\Support\Facades\Session::get('error')}}'
            });
        }
        if ("{{\Illuminate\Support\Facades\Session::has('success')}}"){
            swal.fire({
                icon: 'success',
                title: 'success',
                text: '{{\Illuminate\Support\Facades\Session::get('success')}}'
            });
        }
        if ("{{\Illuminate\Support\Facades\Session::has('warning')}}"){
            swal.fire({
                icon: 'warning',
                title: 'warning',
                text: '{{\Illuminate\Support\Facades\Session::get('warning')}}'
            });
        }
    });
</script>


