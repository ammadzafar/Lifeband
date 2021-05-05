<div class="at-sidebarcontent">
    <div class="at-sidebaruserdetail">
        <div class="at-userimagearea">
            <figure class="at-userimage">
                @if($user_detail->image)
                    <img src="{{asset('uploads/api/images/'.$user_detail->image)}}" alt="user image">
                @else
                    <i class="icon-upload"></i>
                @endif
            </figure>
            <a href="javascript: void(0);" class="at-btnediticon">
                <i class="icon-pen"></i>
            </a>
            <a href="javascript:void(0);" id="delete-icon" class="at-btndeleteicon">
                <i class="icon-trash"></i>
            </a>
        </div>
        <div class="at-usernamedetail">
            <h4 class="name">{{$user_detail->name}}</h4>
            <span>hr manager <span>5698926</span></span>
        </div>
    </div>
    <form class="at-formtheme at-addquestionnaierform">
        <fieldset>
            <div class="form-group">
                <em>Assign Questionnaire</em>
                <span class="at-checkbox">
					<input type="checkbox" id="at-checkboxfive" data-id="{{$user_detail->id}}" {{$user_detail->questionnaire_assigned == 1 ? 'checked' : ''}}>
					<label for="at-checkboxfive"></label>
				</span>
            </div>
        </fieldset>
    </form>
    <div class="at-userbodydetail">
        <ul>
            <li>
                <i class="icon-heightpm"></i>
                <div>
                    <em>{{$user_detail->height . $user_detail->height_unit}}</em>
                    <span>height</span>
                </div>
            </li>
            <li>
                <i class="icon-weightmeter"></i>
                <div>
                    <em>{{$user_detail->weight. $user_detail->weight}}</em>
                    <span>weight</span>
                </div>
            </li>
            <li>
                <i class="icon-target"></i>
                <div>
                    <em>{{$user_detail->personal_goal}}</em>
                    <span>target</span>
                </div>
            </li>
            <li>
                <i class="icon-handwatch"></i>
                <div>
                    <em>{{$user_detail->wear_side}}</em>
                    <span>hand</span>
                </div>
            </li>
        </ul>
    </div>
    <div class="at-timestats">
        <h4>real time stats</h4>
    </div>
    <div class="at-sidebartabs">
        <ul class="nav nav-tabs at-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="at-temp-tab" data-toggle="tab" href="#at-temp" role="tab" aria-controls="home" aria-selected="true">temp</a>
            </li>
           @if($user_detail->heart_rate_filter == true)
                <li class="nav-item">
                    <a class="nav-link" id="at-hr-tab" data-toggle="tab" href="#at-hr" role="tab" aria-controls="profile" aria-selected="false">HR</a>
                </li>
            @endif
            @if($user_detail->blood_pressure_filter == true)
                <li class="nav-item">
                    <a class="nav-link" id="at-bp-tab" data-toggle="tab" href="#at-bp" role="tab" aria-controls="contact" aria-selected="false">BP</a>
                </li>
            @endif
            @if($user_detail->blood_oxygen_filter == true)
                <li class="nav-item">
                    <a class="nav-link" id="at-spo2-tab" data-toggle="tab" href="#at-spo2" role="tab" aria-controls="contact" aria-selected="false">sp02</a>
                </li>
            @endif
            @if($user_detail->fatigue_filter == true)
                <li class="nav-item">
                    <a class="nav-link" id="at-fatige-tab" data-toggle="tab" href="#at-fatige" role="tab" aria-controls="contact" aria-selected="false">fatigue</a>
                </li>
            @endif
        </ul>
        <div class="tab-content at-tadscontent" id="myTabContent">
            <div class="tab-pane at-temptab fade show active" id="at-temp" role="tabpanel" aria-labelledby="at-temp-tab">
                <div class="at-tabstitle">
                    <h5>temperature</h5>
                    <span>{{isset($user_detail->bodyTemperature->value) ?$user_detail->bodyTemperature->value : 0 }}°C</span>
                </div>
                <div class="at-chartseriesname at-tabseriesname">
                    <ul>
                        <li>
                            <em class="at-bggreen"></em>
                            <span>Good Condition</span>
                        </li>
                        <li>
                            <em class="at-bgorange"></em>
                            <span>Mild Temprature</span>
                        </li>
                        <li>
                            <em class="at-bgred"></em>
                            <span>Need Medical Care</span>
                        </li>
                    </ul>
                </div>
                <div class="at-temperatureconditon">
                    <form class="at-formtheme">
                        <fieldset>
                            <input type="range" min="0" max="100" value="0" class="range blue"/>
                        </fieldset>
                    </form>
                </div>
                <div class="at-reloadarea">
                    <a href="javascript: void(0);" class="icon-reload"></a>
                    <span>5 min ago</span>
                </div>
            </div>
            <div class="tab-pane at-hrtab fade" id="at-hr" role="tabpanel" aria-labelledby="at-hr-tab">
                <div class="at-tabstitle">
                    <h5>heart rate</h5>
                    <span>{{$user_detail->heartRateValue() ?? 0}} BPM</span>
                </div>
                <div class="at-averagepercantage at-heartrating">
                    <ul>
                        <li>
                            <span>50%</span>
                        </li>
                        <li>
                            <span>60%</span>
                        </li>
                        <li>
                            <span>100%</span>
                        </li>
                        <li>
                            <span>130%</span>
                        </li>
                    </ul>
                </div>
                <div class="at-temperatureconditon at-colortwo at-spotwocontent">
                    <form class="at-formtheme">
                        <fieldset>
                            <div><input type="range" min="0" max="100" value="0" class="range blue"/></div>
                        </fieldset>
                    </form>
                </div>
                <div class="at-reloadarea">
                    <a href="javascript: void(0);" class="icon-reload"></a>
                    <span>5 min ago</span>
                </div>
            </div>
            <div class="tab-pane at-bptab fade" id="at-bp" role="tabpanel" aria-labelledby="at-bp-tab">
                <div class="at-tabstitle">
                    <h5>Avg BP</h5>
                </div>
                <div class="at-averagebp">
                    <ul>
                        <li>
                            <span class="at-stolicbp">Systolic BP</span>
                            <span class="at-heartbeat">{{isset($user_detail->bloodPressure->low_value) ? $user_detail->bloodPressure->low_value : 0}} <em>mmhg</em></span>
                            <em class="at-hypotension">Hypotension</em>
                        </li>
                        <li>
                            <span class="at-stolicbp">Diastolic BP</span>
                            <span class="at-heartbeat">{{isset($user_detail->bloodPressure->high_value) ? $user_detail->bloodPressure->high_value : 0}} <em>mmhg</em></span>
                            <em class="at-hypotension">Hypertension</em>
                        </li>
                    </ul>
                </div>
                <div class="at-temperatureconditon">
                    <form class="at-formtheme">
                        <fieldset>
                            <input type="range" min="0" max="100" value="0" class="range blue"/>
                        </fieldset>
                    </form>
                </div>
                <div class="at-reloadarea">
                    <a href="javascript: void(0);" class="icon-reload"></a>
                    <span>5 min ago</span>
                </div>
            </div>
            <div class="tab-pane at-spotab fade" id="at-spo2" role="tabpanel" aria-labelledby="at-spo2-tab">
                <div class="at-tabstitle">
                    <h5>Avg {{isset($user_detail->bloodOxygen->value) ? $user_detail->bloodOxygen->value : ''}}</h5>
                </div>
                <div class="at-chartseriesname at-tabseriesname">
                    <ul>
                        <li>
                            <em class="at-bgred"></em>
                            <span>low</span>
                        </li>
                        <li>
                            <em class="at-bgorange"></em>
                            <span>Slightly Lower</span>
                        </li>
                        <li>
                            <em class="at-bggreen"></em>
                            <span>normal</span>
                        </li>
                    </ul>
                </div>
                <div class="at-averagepercantage">
                    <ul>
                        <li>
                            <span>90%</span>
                        </li>
                        <li>
                            <span>95%</span>
                        </li>
                        <li>
                            <span>100%</span>
                        </li>
                    </ul>
                </div>
                <div class="at-temperatureconditon at-colortwo">
                    <form class="at-formtheme">
                        <fieldset>
                            <input type="range" min="0" max="100" value="0" class="range blue"/>
                        </fieldset>
                    </form>
                </div>
                <div class="at-reloadarea">
                    <a href="javascript: void(0);" class="icon-reload"></a>
                    <span>5 min ago</span>
                </div>
            </div>
            <div class="tab-pane at-fatiguetab fade" id="at-fatige" role="tabpanel" aria-labelledby="at-fatige-tab">
                <div class="at-tabstitle">
                    <h5>Fatigue</h5>
                </div>
                <div class="at-chartseriesname at-tabseriesname">
                    <ul>
                        <li>
                            <em class="at-bggreen"></em>
                            <span>Good Condition</span>
                        </li>
                        <li>
                            <em class="at-bgorange"></em>
                            <span>Mild Fatigue</span>
                        </li>
                        <li>
                            <em class="at-bgred"></em>
                            <span>Need Rest</span>
                        </li>
                    </ul>
                </div>
                <div class="at-temperatureconditon">
                    <form class="at-formtheme">
                        <fieldset>
                            <input type="range" min="0" max="100" value="0" class="range blue"/>
                        </fieldset>
                    </form>
                </div>
                <div class="at-reloadarea">
                    <a href="javascript: void(0);" class="icon-reload"></a>
                    <span>5 min ago</span>
                </div>
            </div>
        </div>
    </div>
</div>
