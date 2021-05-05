@extends('layouts.admin')
@section('title'.'Life Band History')
@section('content')
    <!--************************************
				Sidebar Start
		*************************************-->
    <aside class="at-sidebarwrappervtwo">
        <div class="at-sidebartitle">
            <h3>detail</h3>
            <a href="javascript: void(0);" class="at-btneyeicons">
                <i class="fas fa-times"></i>
            </a>
        </div>
        <div class="at-sidebarcontent">
            <div class="at-totalrespons">
                <span class="at-questiondate">total response / 2</span>
            </div>
            <form class="at-formtheme at-qusetionform">
                <fieldset>
                    <div class="at-questions">
                        <div class="at-responsuserdetail">
                            <figure>
                                <img src="{{asset('asset/images/user.png')}}" alt="user image">
                            </figure>
                            <h4>stark brown</h4>
                        </div>
                        <div class="at-question">
                            <h4>Q: How is your average temp?</h4>
                        </div>
                        <div class="form-group">
								<span class="at-radio">
									<input type="radio" id="radio1" name="radio">
									<label for="radio1">normal</label>
								</span>
                        </div>
                        <div class="form-group">
								<span class="at-radio">
									<input type="radio" id="radio2" name="radio">
									<label for="radio2">Mild temperature</label>
								</span>
                        </div>
                        <div class="form-group">
								<span class="at-radio">
									<input type="radio" id="radio3" name="radio">
									<label for="radio3">High temperature</label>
								</span>
                        </div>
                        <div class="form-group">
                            <span class="at-questiondate">2nd Feb, 2020 15:24</span>
                        </div>
                    </div>
                    <div class="at-questions">
                        <div class="at-responsuserdetail">
                            <figure>
                                <img src="{{asset('asset/images/user.png')}}" alt="user image">
                            </figure>
                            <h4>stark brown</h4>
                        </div>
                        <div class="at-question">
                            <h4>Q: How is your average temp?</h4>
                        </div>
                        <div class="form-group">
								<span class="at-radio">
									<input type="radio" id="radio1" name="radio">
									<label for="radio1">normal</label>
								</span>
                        </div>
                        <div class="form-group">
								<span class="at-radio">
									<input type="radio" id="radio2" name="radio">
									<label for="radio2">Mild temperature</label>
								</span>
                        </div>
                        <div class="form-group">
								<span class="at-radio">
									<input type="radio" id="radio3" name="radio">
									<label for="radio3">High temperature</label>
								</span>
                        </div>
                        <div class="form-group">
                            <span class="at-questiondate">2nd Feb, 2020 15:24</span>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </aside>
    <!--************************************
            Sidebar End
    *************************************-->
    <!--************************************
				Main Start
		*************************************-->
    <main id="at-main" class="at-main at-haslayout">
        <div class="at-dashboard at-users at-history">
            <div class="at-content">
                <div class="at-userscontent at-questionnaiercontent at-historycontent">
                    <div class="at-usershead">
                        <div class="at-pagetitle">
                            <h2>history</h2>
                        </div>
                        <div class="at-btnholder">
{{--                            @if(isset($organization))--}}
{{--                                <a href="{{route('create.questionnaire',$organization->id)}}" class="at-btn at-bggreen">create question</a>--}}
{{--                            @elseif(isset($family_account))--}}
{{--                                <a href="{{route('create.questionnaire',$family_account->id)}}" class="at-btn at-bggreen">create question</a>--}}
{{--                            @else--}}
                                <a href="{{route('user.questionnaire',['id'=>auth()->user()->id])}}" class="at-btn at-bggreen">create question</a>
{{--                            @endif--}}
                        </div>
                    </div>
                    <div class="at-historycontentholder">
                      @foreach($questionnaire as $question)
                        <div class="at-questionhistory">
                            <div class="at-questiondetailedit">
                                <h3 class="question">Q: {{$question->questionnaire}}</h3>
                                <div class="at-editdeletebtnholder">
                                    <a href="javascript: void(0);" class="at-btneyeicons">
                                        <i class="icon-eye"></i>
                                    </a>
                                    <a href="javascript: void(0);">
                                        <i class="icon-trash" data-id="{{$question->id}}"></i>
                                    </a>
                                </div>
                            </div>
                            @php($i='A')
                            @foreach($question->options as $key => $opt)
                               <div class="at-editoption">
                                   @php(alphabet_increment($key))
                                   <span class="question-opt">{{alphabet_increment($key)}}: {{$opt->name}}</span>
                               </div>
                            @endforeach
                            <span class="at-questiondate">{{$question->created_at}}</span>
                        </div>
                      @endforeach
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
        $(document).ready(function(){
            $(document).on('click','.icon-trash',function(e){

                let data = {
                    '_token':'{{csrf_token()}}',
                    'question_id': $(this).data('id'),
                };
                $(this).parent().parent().parent().parent().remove();
                $.post('/superadmin/questionnaire/delete',data,function (response) {
                    if (response.status == 'success'){
                        alert(response.message);
                    }
                })
            });
        });
    </script>
    @endsection
