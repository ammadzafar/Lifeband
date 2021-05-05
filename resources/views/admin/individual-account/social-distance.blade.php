@extends('layouts.admin')
@section('title','Life Band Social Distance')
@section('content')

    <!--************************************
				Main Start
		*************************************-->
    <main id="at-main" class="at-main at-haslayout">
        <div class="at-dashboard at-socialdistance">
            <div class="at-content">
                <form class="at-formtheme">
                    <fieldset>
                        <div class="at-socialdistancecontent">
                            <div class="at-socialdistancing">
                                <div class="at-sectiontitle">
                                    <h2>Social Distancing</h2>
                                </div>
                                @if($safe || $medium || $high > 0)
                                    <div id="at-socialdestanicingchart" class="at-socialdestanicingchart"></div>
                                @else
                                    <span class="at-centeralign text-center">No data to show</span>
                                @endif
                                <div class="at-chartseriesname">
                                    <ul>
                                        <li>
                                            <em class="at-bggreen"></em>
                                            <span>Safe</span>
                                        </li>
                                        <li>
                                            <em class="at-bgorange"></em>
                                            <span>Mild Risk</span>
                                        </li>
                                        <li>
                                            <em class="at-bgred"></em>
                                            <span>High Risk</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="at-covidinfacted at-socialdistancing">
                                <div class="at-sectiontitle">
                                    <h2>Social Distancing</h2>
                                </div>
                                <div class="at-chartseriesname">
                                    <ul>
                                        <li>
                                            <em class="at-bggreen"></em>
                                            <span>Not Infected</span>
                                        </li>
                                        <li>
                                            <em class="at-bgred"></em>
                                            <span>Infected</span>
                                        </li>
                                    </ul>
                                </div>
                                @if($infected || $not_infected > 0)
                                    <div class="at-notinfacted">
                                        {{--                                    <i class="icon-infacted"></i>--}}
                                        <span class="val-ntinfected">{{$not_infected}}%</span>
                                    </div>

                                    <div class="at-notinfacted at-infacted">
                                        {{--                                    <i class="icon-infacted"></i>--}}
                                        <span class="val-infected">{{$infected}}%</span>
                                    </div>
                                    <div id="at-covidinfactedchart" class="at-socialdestanicingchart at-covidinfactedchart"></div>
                                @else
                                    <span class="at-centeralign text-center">No data to show</span>
                                @endif
                            </div>
                            <div class="at-sdviolaions at-sdviolaionsvtwo">
                                @include('admin.individual-account.distance-violation')
                            </div>
                            <div class="at-sdviolaions at-employtracing">
                                @include('admin.individual-account.employ-tracing')
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </main>
    <!--************************************
            Main End
    *************************************-->
@endsection
@section('scripts')
    <script>
        Highcharts.chart('at-socialdestanicingchart', {
            chart: {
                height: 250,
                plotBackgroundColor: null,
                plotBorderWidth: 0,
                plotShadow: false
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    dataLabels: {
                        enabled: true,
                        distance: -50,
                        style: {
                            fontWeight: 'bold',
                            color: 'white'
                        }
                    },
                    startAngle: -270,
                    endAngle: 90,
                    center: ['50%', '50%'],
                    size: '110%'
                }
            },
            series: [{
                type: 'pie',
                // name: 'Browser share',
                innerSize: '20%',
                data: [

                    ['{{$safe}}%', {{$safe}}],
                    ['{{$medium}}%',{{$medium}}],
                    ['{{$high}}%',{{$high}}],
                ]
            }]
        });
    </script>
    <script>
        Highcharts.chart('at-covidinfactedchart', {
            chart: {
                height: 260,
                plotBackgroundColor: null,
                plotBorderWidth: 0,
                plotShadow: false
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    dataLabels: {
                        enabled: true,
                        distance: -50,
                        style: {
                            fontWeight: 'bold',
                            color: 'white'
                        }
                    },
                    startAngle: -270,
                    endAngle: 90,
                    center: ['50%', '50%'],
                    size: '110%'
                }
            },
            series: [{
                type: 'pie',
                // name: 'Browser share',
                innerSize: '60%',
                data: [
                    ['', {{$not_infected}}],
                    ['', {{$infected}}],
                ]
            }]
        });
    </script>
    <script>
        $(document).ready(function() {
            $(function() {
                $('#daterange').daterangepicker({
                    timePicker: false,
                    startDate: moment().startOf('hour'),
                    endDate: moment().startOf('hour').add(32, 'hour'),
                    locale: {
                        format: 'YYYY-MM-DD '
                    }
                });
                $('input[name="violation"]').on('apply.daterangepicker', function(ev, picker) {

                    $(this).val(picker.startDate.format('YYYY-MM-DD') + ' _ ' + picker.endDate.format('YYYY-MM-DD'));

                    let url = '{{route('individual.distance.violation')}}';
                    let data = {
                        'date' : $('#daterange').val(),
                    };
                    $.get(url,data,function (response){
                        if (response.status == 'success'){

                            $('.val-ntinfected').text(response.user_ntinfected + '%');
                            $('.val-infected').text(response.user_infected + '%');

                            Highcharts.chart('at-covidinfactedchart', {
                                chart: {
                                    height: 260,
                                    plotBackgroundColor: null,
                                    plotBorderWidth: 0,
                                    plotShadow: false
                                },
                                tooltip: {
                                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                },
                                accessibility: {
                                    point: {
                                        valueSuffix: '%'
                                    }
                                },
                                plotOptions: {
                                    pie: {
                                        dataLabels: {
                                            enabled: true,
                                            distance: -50,
                                            style: {
                                                fontWeight: 'bold',
                                                color: 'white'
                                            }
                                        },
                                        startAngle: -270,
                                        endAngle: 90,
                                        center: ['50%', '50%'],
                                        size: '110%'
                                    }
                                },
                                series: [{
                                    type: 'pie',
                                    // name: 'Browser share',
                                    innerSize: '60%',
                                    data: [
                                        ['', response.user_ntinfected],
                                        ['', response.user_infected],
                                    ]
                                }]
                            });


                            $('.violation-distance').empty();
                            if (response.violation.length > 0){
                                let i = 1;
                                $.each(response.violation,function (index,value){
                                        let record = '<tr>\n' +
                                            '                    <td>'+ i +'</td>\n' +
                                            '                    <td>\n' +
                                            '                        <div>\n' +
                                            '                            <figure>\n' +
                                            '                                <img src="{{asset('uploads/api/images/')}}/'+value.image+'"  >\n' +
                                            '                            </figure>\n' +
                                            '                            <em>'+value.name+'</em>\n' +
                                            '                        </div>\n' +
                                            '                    </td>\n' +
                                            '                    <td class="status-btn">\n'+
                                            '                    <span class="'+value.status+'" data-id="'+value.id+'">'+value.status+'</span>\n' +
                                            '                    </td>\n' +
                                            '                </tr>';
                                        i++;
                                        $('.violation-distance').append(record);
                                });
                            }else{
                                $('.violation-distance').append('<tr><td></td><td></td><td></td></tr>','<tr><td></td><td>No Record Found!</td><td></td></tr>');
                            }
                        }
                    })
                });
                $('input[name="violation"]').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });
            });

            $(function() {
                $('#daterange2').daterangepicker({
                    timePicker: false,
                    startDate: moment().startOf('hour'),
                    endDate: moment().startOf('hour').add(32, 'hour'),
                    locale: {
                        format: 'YYYY-MM-DD '
                    }
                });

                // $('input[name="tracing"]').daterangepicker({
                //     autoUpdateInput: false,
                //     locale: {
                //         cancelLabel: 'Clear'
                //     }
                // });

                $('input[name="tracing"]').on('apply.daterangepicker', function(ev, picker) {

                    $(this).val(picker.startDate.format('YYYY-MM-DD') + ' _ ' + picker.endDate.format('YYYY-MM-DD'));

                    let url = '{{route('individual.employ.tracing')}}';
                    let data = {
                        'date' : $('#daterange2').val(),
                    };
                    $.get(url,data,function (response){
                        if (response.status == 'success'){
                            $('.filter-data').empty();
                            if (response.filter){
                                $.each(response.filter,function (index,value){
                                    $.each(value,function (key,j){
                                        if (j.contacted_person != ''){
                                            let record = '<tr>\n' +
                                                '                            <td>'+j.name+'</td>\n' +
                                                '                            <td>'+j.contacted_person+'</td>\n' +
                                                '                            <td>'+j.date+'</td>\n' +
                                                '                            <td>'+j.time+'</td>\n' +
                                                '                        </tr>';

                                            $('.filter-data').append(record);
                                        }
                                    });
                                });
                            }else{
                                $('.filter-data').append('<tr><td></td><td></td><td></td></tr>','<tr><td></td><td>No Record Found!</td><td></td></tr>');
                            }
                        }
                    })
                });
                $('input[name="tracing"]').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });
            });

            $(document).on('click','.infected',function (){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Change the status to not infected!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).addClass('at-colorgreen not-infected');
                        $(this).removeClass('at-bordercolorred infected');
                        $(this).text('Not Infected');

                        let data = {
                            '_token': '{{csrf_token()}}',
                            'id': $(this).data('id'),
                            'status' : 'Not-Infected',
                        };
                        var url="{{route('individual.account.status')}}"
                        $.post(url,data,function (response) {

                            $('.val-infected').text(response.infected  + '%');
                            $('.val-ntinfected').text(response.not_infected  + '%');

                            Swal.fire({
                                title:  'Your successfully changed the status',
                                confirmButtonText: `Ok`
                            }).then((result) => {
                                location.reload();
                            })
                        })
                    }
                })

            })
            $(document).on('click','.not-infected',function (){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Change the status to infected!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).removeClass('at-colorgreen not-infected');
                        $(this).addClass('at-bordercolorred infected');
                        $(this).text('Infected');

                        let data = {
                            '_token': '{{csrf_token()}}',
                            'id': $(this).data('id'),
                            'status' : 'Infected',
                        };
                        var url="{{route('individual.account.status')}}"
                        $.post(url,data,function (response) {

                            $('.val-infected').text(response.infected  + '%');
                            $('.val-ntinfected').text(response.not_infected  + '%');

                            Swal.fire({
                                title:  'Your successfully changed the status',
                                confirmButtonText: `Ok`
                            }).then((result) => {
                                location.reload();
                            })
                        })
                    }
                })
            })

        });
    </script>
@endsection
