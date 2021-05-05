<div class="at-sidebarcontent">
    <form class="at-formtheme at-qusetionform">
        <fieldset>
            <div class="at-questions">
                <div class="at-question">
                    <h4>Q: {{$responses->questions->questionnaire}}</h4>
                </div>
                @foreach($responses->questions->options as $option)
                <div class="form-group">
						<span class="at-radio">
							<input type="radio" id="radio1" name="radio" @if(strtolower($responses->answer) == strtolower($option->name)) {{"checked"}}  @endif>
								<label for="radio1">{{$option->name}} </label>
						</span>
                </div>
                @endforeach
                <div class="form-group">
                    <span class="at-questiondate">2nd Feb, 2020 15:24</span>
                </div>
            </div>
        </fieldset>
    </form>
</div>
