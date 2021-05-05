@extends('layouts.admin')
@section('title','Life Band Dashboard')
@section('content')
    <!--************************************
				Main Start
		*************************************-->
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
                    <div class="at-stats">
                        <ul>
                            <li>
                                <div class="at-stat">
                                    <div class="at-statcontent">
                                        <h3>{{count($family_account->familyAccountUsers) > 10 ? count($family_account->familyAccountUsers) : '0'.count($family_account->familyAccountUsers)}}</h3>
                                        <span>total users</span>
                                    </div>
                                    <span class="at-staticon">
											<i class="icon-users"></i>
										</span>
                                </div>
                            </li>
                            <li>
                                <div class="at-stat">
                                    <div class="at-statcontent">
                                        <h3>03</h3>
                                        <span>Active Users</span>
                                    </div>
                                    <span class="at-staticon">
											<i class="icon-eye"></i>
										</span>
                                </div>
                            </li>
                            <li>
                                <div class="at-stat">
                                    <div class="at-statcontent">
                                        <h3>02</h3>
                                        <span>Non-Active Users</span>
                                    </div>
                                    <span class="at-staticon">
											<i class="icon-hideeye"></i>
										</span>
                                </div>
                            </li>
                            <li>
                                <div class="at-stat">
                                    <div class="at-statcontent">
                                        <h3>02</h3>
                                        <span>Total Breaches</span>
                                    </div>
                                    <span class="at-staticon">
											<i class="icon-socialdestance"></i>
										</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="at-activity">
                        <div class="at-sectiontitle">
                            <h2>Activity</h2>
                        </div>
                        <div id="at-activechart" class="at-actiechart"></div>
                        <div class="at-chartseriesname at-activechartseries">
                            <ul>
                                <li>
                                    <em class="at-bgblue"></em>
                                    <span>Active</span>
                                </li>
                                <li>
                                    <em class="at-bgorange"></em>
                                    <span>Close Contact</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="at-temperature at-activity">
                        <div class="at-sectiontitle">
                            <h2>temperature</h2>
                        </div>
                        <div id="at-temperaturechart" class="at-temperaturechart"></div>
                        <div class="at-chartseriesname">
                            <ul>
                                <li>
                                    <em class="at-bggreen"></em>
                                    <span>Normal</span>
                                </li>
                                <li>
                                    <em class="at-bgblue"></em>
                                    <span>Mild</span>
                                </li>
                                <li>
                                    <em class="at-bgorange"></em>
                                    <span>High</span>
                                </li>
                                <li>
                                    <em class="at-bgred"></em>
                                    <span>Very High</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="at-widgets">
                    <div class="at-activepeoplewidget">
                        <div class="at-widgettitle">
                            <h3>Stats for the day</h3>
                        </div>
                        <div class="at-widgetcontent">
                            <figure class="at-orgnizerimg">
                                <img src="{{asset('uploads/family/images/'.$family_account->image)}}" alt="family image">
                            </figure>
                            <div class="at-orgnizertitle">
                                <h3>{{$family_account->admin_name}}</h3>
                                <span>Family Admin</span>
                            </div>
                            <div class="at-activepeoplelist">
                                <h3>3 people active</h3>
                                <span>current bands active</span>
                                <div class="at-progressber">
                                    <div class="at-progresbarcontent"></div>
                                </div>
                                <em>3/5</em>
                            </div>
                            <div class="at-widgetcontacts">
                                <ul>
                                    <li>
                                        <div class="at-widgetcontact">
                                            <h4 class="at-coloryellow">{{$count_medium}}</h4>
                                            <span>near contacts</span>
                                        </div>
                                        <figure class="at-widgetalertimg">
                                            <img src="{{asset('asset/images/near.png')}}" alt="near image">
                                        </figure>
                                    </li>
                                    <li>
                                        <div class="at-widgetcontact">
                                            <h4 class="at-color2">{{$count_high}}</h4>
                                            <span>danger contacts</span>
                                        </div>
                                        <figure class="at-widgetalertimg">
                                            <img src="{{asset('asset/images/danger.png')}}" alt="danger image">
                                        </figure>
                                    </li>
                                    <li>
                                        <div class="at-widgetcontact">
                                            <h4 class="at-colorred">{{$count_safe}}</h4>
                                            <span>safe contacts</span>
                                        </div>
                                        <figure class="at-widgetalertimg">
                                            <img src="{{asset('asset/images/gralert.png')}}" alt="alert image">
                                        </figure>
                                    </li>
                                </ul>
                                {{--                                <div class="at-dailyaverage">--}}
                                {{--                                    <h5>Family Daily Average</h5>--}}
                                {{--                                    <div class="at-progressber">--}}
                                {{--                                        <div class="at-progresbarcontent">--}}
                                {{--                                            <span>6h 34m</span>--}}
                                {{--                                        </div>--}}
                                {{--                                        <span>2h26m</span>--}}
                                {{--                                    </div>--}}
                                {{--                                    <div class="at-barcontent">--}}
                                {{--                                        <span>Socially Distant</span>--}}
                                {{--                                        <span>In Contact</span>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                    <div class="at-packagewidget">
                        <figure class="at-packagewidgetimg">
                            <img src="{{asset('asset/images/watch.png')}}" alt="">
                        </figure>
                        <div class="at-packagecontent">
                            <h5>5 bands package</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--************************************
            Main End
    *************************************-->
@endsection
@section('scripts')
    <script>
        $(document).ready(function (){
            /*--------------------------------------
         Chart 1
 --------------------------------------*/
            Highcharts.chart('at-activechart', {
                chart: {
                    type: 'spline'
                },
                xAxis: {
                    categories: ['{{$userArr[1]['month']}}', '{{$userArr[2]['month']}}', '{{$userArr[3]['month']}}', '{{$userArr[4]['month']}}', '{{$userArr[5]['month']}}', '{{$userArr[6]['month']}}',
                        '{{$userArr[7]['month']}}', '{{$userArr[8]['month']}}', '{{$userArr[9]['month']}}', '{{$userArr[10]['month']}}', '{{$userArr[11]['month']}}', '{{$userArr[12]['month']}}']
                },
                yAxis: {
                    title: {
                        text: 'Temperature'
                    },
                    labels: {
                        formatter: function () {
                            return this.value ;
                        },
                        colors: ['#2f7ed8', '#0d233a'],

                    }
                },
                tooltip: {
                    crosshairs: true,
                    shared: true
                },
                plotOptions: {
                    spline: {
                        marker: {
                            radius: 4,
                            lineColor: '#666666',
                            lineWidth: 1
                        },
                    }
                },
                colors: ['#ff9c64', '#0b6297'],
                series: [{
                    marker: {
                        symbol: 'square'
                    },
                    data: [{{$safe_record[1]['count']}}, {{$safe_record[2]['count']}}, {{$safe_record[3]['count']}}, {{$safe_record[4]['count']}}, {{$safe_record[5]['count']}}, {{$safe_record[6]['count']}},
                        {{$safe_record[7]['count']}},{{$safe_record[8]['count']}},{{$safe_record[9]['count']}},{{$safe_record[10]['count']}},{{$safe_record[11]['count']}},{{$safe_record[12]['count']}} ]

                }, {
                    marker: {
                        symbol: 'diamond'
                    },
                    data: [
                        {{$userArr[1]['count']}}, {{$userArr[2]['count']}}, {{$userArr[3]['count']}}, {{$userArr[4]['count']}}, {{$userArr[5]['count']}}, {{$userArr[6]['count']}},
                        {{$userArr[7]['count']}}, {{$userArr[8]['count']}}, {{$userArr[9]['count']}}, {{$userArr[10]['count']}}, {{$userArr[11]['count']}},{{$userArr[12]['count']}}
                    ]
                }]
            });


            /*--------------------------------------
                Chart 2
            --------------------------------------*/
            $(function() {
                'use strict';
                (function(factory) {
                    if (typeof module === 'object' && module.exports) {
                        module.exports = factory;
                    } else {
                        factory(Highcharts);
                    }
                }(function(Highcharts) {
                    (function(H) {
                        H.wrap(H.seriesTypes.column.prototype, 'translate', function(proceed) {
                            const options = this.options;
                            const topMargin = options.topMargin || 0;
                            const bottomMargin = options.bottomMargin || 0;

                            proceed.call(this);

                            H.each(this.points, function(point) {
                                if (options.borderRadiusTopLeft || options.borderRadiusTopRight || options.borderRadiusBottomRight || options.borderRadiusBottomLeft) {
                                    const w = point.shapeArgs.width;
                                    const h = point.shapeArgs.height;
                                    const x = point.shapeArgs.x;
                                    const y = point.shapeArgs.y;

                                    let radiusTopLeft = H.relativeLength(options.borderRadiusTopLeft || 0, w);
                                    let radiusTopRight = H.relativeLength(options.borderRadiusTopRight || 0, w);
                                    let radiusBottomRight = H.relativeLength(options.borderRadiusBottomRight || 0, w);
                                    let radiusBottomLeft = H.relativeLength(options.borderRadiusBottomLeft || 0, w);

                                    const maxR = Math.min(w, h) / 2

                                    radiusTopLeft = radiusTopLeft > maxR ? maxR : radiusTopLeft;
                                    radiusTopRight = radiusTopRight > maxR ? maxR : radiusTopRight;
                                    radiusBottomRight = radiusBottomRight > maxR ? maxR : radiusBottomRight;
                                    radiusBottomLeft = radiusBottomLeft > maxR ? maxR : radiusBottomLeft;

                                    point.dlBox = point.shapeArgs;

                                    point.shapeType = 'path';
                                    point.shapeArgs = {
                                        d: [
                                            'M', x + radiusTopLeft, y + topMargin,
                                            'L', x + w - radiusTopRight, y + topMargin,
                                            'C', x + w - radiusTopRight / 2, y, x + w, y + radiusTopRight / 2, x + w, y + radiusTopRight,
                                            'L', x + w, y + h - radiusBottomRight,
                                            'C', x + w, y + h - radiusBottomRight / 2, x + w - radiusBottomRight / 2, y + h, x + w - radiusBottomRight, y + h + bottomMargin,
                                            'L', x + radiusBottomLeft, y + h + bottomMargin,
                                            'C', x + radiusBottomLeft / 2, y + h, x, y + h - radiusBottomLeft / 2, x, y + h - radiusBottomLeft,
                                            'L', x, y + radiusTopLeft,
                                            'C', x, y + radiusTopLeft / 2, x + radiusTopLeft / 2, y, x + radiusTopLeft, y,
                                            'Z'
                                        ]
                                    };
                                }

                            });
                        });
                    }(Highcharts));
                }));
                Highcharts.chart('at-temperaturechart', {
                    chart: {
                        type: 'column'
                    },
                    xAxis: {
                        categories: ['{{isset($avg_temperature[0])? $avg_temperature[0]['hour'].':'.'00' : '8:00'}}', '{{isset($avg_temperature[1])? $avg_temperature[1]['hour'].':'.'00' : '9:00'}}', '{{isset($avg_temperature[2])? $avg_temperature[2]['hour'].':'.'00' : '10:00'}}', '{{isset($avg_temperature[3])? $avg_temperature[3]['hour'].':'.'00' : '11:00'}}',
                            '{{isset($avg_temperature[4])? $avg_temperature[4]['hour'].':'.'00' : '12:00'}}', '{{isset($avg_temperature[5])? $avg_temperature[5]['hour'].':'.'00' : '13:00'}}','{{isset($avg_temperature[6])? $avg_temperature[6]['hour'].':'.'00' : '14:00'}}', '{{isset($avg_temperature[7])? $avg_temperature[7]['hour'].':'.'00' : '15:00'}}',
                            '{{isset($avg_temperature[8])? $avg_temperature[8]['hour'].':'.'00' : '16:00'}}', '{{isset($avg_temperature[9])? $avg_temperature[9]['hour'].':'.'00' : '17:00'}}','{{isset($avg_temperature[10])? $avg_temperature[10]['hour'].':'.'00' : '18:00'}}', '{{isset($avg_temperature[11])? $avg_temperature[11]['hour'].':'.'00' : '19:00'}}',]
                    },



                    plotOptions: {
                        column: {
                            pointWidth: 10,
                            pointPadding: 0.2,
                            borderWidth: 0,
                            grouping: true,
                            borderRadiusTopLeft: 20,
                            borderRadiusTopRight: 20
                        }
                    },
                    series: [{
                        type: 'column',
                        colorByPoint: true,
                        showInLegend: false,
                        data: [
                            {{isset($avg_temperature[0]) ? $avg_temperature[0]['avg_temperature'] : '0'}},{{isset($avg_temperature[1]) ? $avg_temperature[1]['avg_temperature'] : '0'}},{{isset($avg_temperature[2]) ? $avg_temperature[2]['avg_temperature'] : '0'}},
                            {{isset($avg_temperature[3]) ? $avg_temperature[3]['avg_temperature'] : '0'}},{{isset($avg_temperature[4]) ? $avg_temperature[4]['avg_temperature'] : '0'}},{{isset($avg_temperature[5]) ? $avg_temperature[5]['avg_temperature'] : '0'}},
                            {{isset($avg_temperature[6]) ? $avg_temperature[6]['avg_temperature'] : '0'}},{{isset($avg_temperature[7]) ? $avg_temperature[7]['avg_temperature'] : '0'}},{{isset($avg_temperature[8]) ? $avg_temperature[8]['avg_temperature'] : '0'}},
                            {{isset($avg_temperature[9]) ? $avg_temperature[9]['avg_temperature'] : '0'}},{{isset($avg_temperature[10]) ? $avg_temperature[10]['avg_temperature'] : '0'}},{{isset($avg_temperature[11]) ? $avg_temperature[11]['avg_temperature'] : '0'}},
                        ]

                        // name: 'Tokyo',
                        // data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
                        // }, {

                        // name: 'New York',
                        // data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

                        // }, {

                        // name: 'London',
                        // data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

                        // }, {
                        // name: 'Berlin',
                        // data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

                    }]
                });
            });
            /*--------------------------------------
                Chart 3
            --------------------------------------*/
        });

    </script>
@endsection
