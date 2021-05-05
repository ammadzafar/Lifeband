@extends('layouts.admin')
@section('title'.'Life Band Questionnaire')
@section('content')
    <!--************************************
				Main Start
		*************************************-->
    <main id="at-main" class="at-main at-haslayout">
        <div class="at-dashboard at-users at-questionnaier">
            <div class="at-content">
                <div class="at-userscontent at-questionnaiercontent">
                    <div class="at-usershead">
                        <div class="at-pagetitle">
                            <h2>Questionnaire</h2>
                        </div>
                        <div class="at-btnholder">
                            @if(isset($organization))
                            <a href="{{--{{route('organization.questionnaire.response',$organization->id)}}--}}" class="at-btn at-bggreen">check responses</a>
                            @elseif(isset($family_account))
                                <a href="{{--{{route('family.questionnaire.response',$family_account->id)}}--}}" class="at-btn at-bggreen">check responses</a>
                            @else
                                <a href="{{route('questionnaire.response',$user->id)}}" class="at-btn at-bggreen">check responses</a>
                            @endif

                            @if(isset($organization))
                                <a href="{{route('history.questionnaire',$organization->id)}}" class="at-btn at-bggreen at-btnhistory">history</a>
                            @elseif(isset($family_account))
                                <a href="{{route('history.questionnaire',$family_account->id)}}" class="at-btn at-bggreen at-btnhistory">history</a>
                            @else
                                <a href="{{route('admin.questionnaire.history',$user->id)}}" class="at-btn at-bggreen at-btnhistory">history</a>
                            @endif

                        </div>
                    </div>
                    <div class="at-addquestion">
                        <form class="at-formtheme at-addquestionform">
                            <fieldset>
                                <div class="form-group">
                                    <a href="javascript: void(0);" class="at-btnaddquetion">+ add question</a>
                                </div>
                                <div class="form-group">
                                    <div class="at-wtitequestion">
                                        <textarea class="question" name="questionnaire"></textarea>
                                        <a id="at-btnnext" href="javascript: void(0);" class="at-btn at-bggreen at-btnnext at-btnerror">next</a>
                                        <div class="question-error at-error"> </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="at-addoptionholder">
                                        <h3 class="submit-question"></h3>
                                        <a href="#" class="at-btnaddoption">+ Add a option</a>
                                    </div>
                                    <div class="at-writeoption">
{{--                                        <input type="text" name="option" placeholder="Write option...">--}}
                                        <a href="#" class="at-btn at-bggreen at-btnnexttwo">next</a>
                                    </div>
                                </div>
                                <div class="form-group at-showquetionopetion">
                                    <h3 class="submit-question2"></h3>
                                    @if(isset($organization))
                                       <input class="qst-create" type="hidden" value="{{$organization->id}}">
                                    @elseif(isset($family_account))
                                       <input class="qst-create" type="hidden" value="{{$family_account->id}}">
                                    @else
                                       <input class="qst-create" type="hidden" value="{{isset($user) ? $user->id : ''}}">
                                    @endif
                                    <div class="rt-editoptionholder">
{{--                                        <div class="at-editoption">--}}
{{--                                            <span class="option-value">A: Tasteful</span>--}}
{{--                                            <div class="at-editdeletebtnholder">--}}
{{--                                                <a href="javascript: void(0);">--}}
{{--                                                    <i class="icon-pen"></i>--}}
{{--                                                </a>--}}
{{--                                                <a href="javascript: void(0);">--}}
{{--                                                    <i class="icon-trash"></i>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
                                    <a href="javascritp: void(0);" class="at-btn at-bggreen at-btnsubmitquestion" data-toggle="modal" data-target="#exampleModalCentervtwo">submit</a>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--************************************
            Main End
    *************************************-->
    <!--************************************
		quetion subitted Modal Start
	*************************************-->
    <div class="modal fade at-modaltheme at-creatusermodal at-sentinvitemodal at-questionmodal" id="exampleModalCentervtwo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <figure class="at-sentinviteimage">
                        <img src="{{asset('asset/images/question.png')}}" alt="question image">
                    </figure>
                    <div class="at-sentinvitecontent">
                        <div class="at-modaltitle">
                            <h3>QUESTION SUBMITTED</h3>
                        </div>
                        <div class="at-description">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore gorisns sdlsiowe.</p>
                        </div>
                        @if(isset($organization))
                            <a href="{{route('create.questionnaire',$organization->id)}}" class="at-btn at-bggreen">continue</a>
                        @elseif(isset($family_account))
                            <a href="{{route('create.questionnaire',$family_account->id)}}" class="at-btn at-bggreen">continue</a>
                        @else
                            <a href="{{route('user.questionnaire',$user->id)}}" class="at-btn at-bggreen">continue</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--************************************
        quetion subitted Modal End
    *************************************-->
    @endsection
@section('scripts')
    <script>
            $(document).ready(function () {
                let preloader = $(document).find('#status');
                $(document).on('click','.at-btnnext',function(e){

                    if ($('.question').val() == ''){
                        $('.question-error').text('** Textarea is Required');
                        $('.question-error').css({'color':'#ff5a5f'});
                        $('.at-wtitequestion').css({'display':'block'});
                        $('.at-btnnext').css({'display':'block'});
                        $('.at-addoptionholder').css({'display':'none'});
                    }else{
                        let data = {
                            '_token': '{{csrf_token()}}',
                            'question': $('.question').val(),
                            'id':$('.qst-create').val(),
                        };
                        preloader.removeClass('d-none');

                        $.post('/superadmin/questionnaire/store',data,function(response){

                            if(response.status == 'success'){
                                $('.submit-question').append('Q: '+ data['question']);
                                $('.submit-question2').append('Q: '+ data['question']);
                                preloader.addClass('d-none');
                                $(document).on('click','.at-btnaddoption',function () {
                                    let option = '<input type="text" id="que-option" name="option[]" placeholder="Write option..."><br><br><br>';
                                    $(option).insertBefore('.at-btnnexttwo');
                                })
                            }
                            $(document).on('click','.at-btnnexttwo',function(){
                                let optionArray = [];

                                $('input[name="option[]"]').each(function() {
                                    optionArray.push($(this).val())
                                });

                                let question_id = response.question_id;
                                let answers = {
                                    '_token':'{{csrf_token()}}',
                                    'options':optionArray,
                                    'id':question_id,
                                };
                                $.post('/superadmin/questionnaire/options/store',answers,function (response) {
                                    if(response.status == 'success'){
                                        let i=65;
                                        $.each(response.options, function( index, options) {
                                            // console.log(options.name)
                                            let alphabet = String.fromCharCode(i++);
                                            /*'+ alphabet + ':*/
                                            $('.rt-editoptionholder').append('<div class="at-editoption">\n' +
                                                '                             <span class="opt-name" data-id='+options.id+'>' +options.name+'</span>\n' +
                                                '                                  <div class="at-editdeletebtnholder">\n' +
                                                '                                       <a href="javascript: void(0);">\n' +
                                                '                                            <i class="icon-pen"></i>\n' +
                                                '                                        </a>\n' +
                                                '                                        <a href="javascript: void(0);">\n' +
                                                '                                                <i class="icon-trash" data-id='+options.id+'></i>\n' +
                                                '                                        </a>\n' +
                                                '                                   </div>\n' +
                                                '                           </div>')
                                        });
                                    }
                                });
                                let data_id = null;
                                $(document).on('click','.icon-pen',function(){
                                    let opt_name = $(this).parents('.at-editoption').find('.opt-name').text();
                                    data_id = $(this).parents('.at-editoption').find('.opt-name').data("id");
                                    let span_tag = $(this).parents('.at-editoption').find("span");
                                    let input = '<input class="edit-opt" type="text" data-value="'+data_id+'" id="que-option" name="option1[]" value="'+opt_name+'" placeholder="Write option...">';
                                    span_tag.replaceWith( input );

                                });
                                $(document).on('click','.edit-opt',function(e){
                                    $(this).focusout(function(){
                                        let new_value = $(this).val();
                                        $(this).replaceWith('<span class="opt-name" data-id='+data_id+'>' +new_value+'</span>');
                                        console.log(new_value);
                                        console.log(data_id);

                                        let update_data = {
                                            '_token':'{{csrf_token()}}',
                                            'update_option':new_value,
                                            'option_id':data_id,
                                        };
                                        $.post('/superadmin/questionnaire/options/update',update_data,function (response) {
                                            if(response.status == 'success'){
                                                alert(response.message);
                                            }
                                        });
                                    });
                                });
                                $(document).on('click','.icon-trash',function(){
                                    $(this).parents('.at-editoption').hide();
                                    let delete_option = $(this).data("id");
                                    let delete_data = {
                                        '_token':'{{csrf_token()}}',
                                        'option_id':delete_option,
                                    };
                                    $.post('/superadmin/questionnaire/options/delete',delete_data,function (response) {
                                        if(response.status == 'success'){
                                            alert(response.message);
                                        }
                                    })
                                })
                            })
                        })
                    }
                })
            });
    </script>
    @endsection
