@extends('layouts.admin')
@section('title'.'Life Band Questionnaire')
@section('content')
    <!--************************************
				Sidebar Start
		*************************************-->
    <aside class="at-sidebarwrappervtwo">
        <div class="at-sidebartitle">
            <h3>detail</h3>
            <a href="javascript: void(0);" class="at-btneyeicons at-btneyevtwo">
                <i class="fas fa-times"></i>
            </a>
        </div>
        <div class="questionnaire_detail">
{{--            @include('admin.questionnaire.questionnaire-detail')--}}
        </div>
    </aside>
    <!--************************************
            Sidebar End
    *************************************-->

    <!--************************************
				Main Start
		*************************************-->
    <main id="at-main" class="at-main at-haslayout">
        <div class="at-dashboard at-users at-questionnaier">
            <div class="at-content">
                <div class="at-userscontent at-questionnaiercontent">
                    <div class="at-usershead">
                        <div class="at-pagetitle">
                            <h2>Responses</h2>
                        </div>
                        <div class="at-btnholder">
                            <a href="{{route('user.questionnaire',['id'=>auth()->user()->id])}}" class="at-btn at-bggreen">create question</a>
                        </div>
                    </div>
                </div>
                <div class="at-responsecontent">
                    <table class="at-tabletheme at-responsetable">
                        <thead>
                        <tr>
                            <th>serial</th>
                            <th>picture</th>
                            <th>name</th>
                            <th>orgnization/family</th>
                            <th>resource person</th>
                            <th>action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($responses as $response)
                        <tr>
                            <td>
                                <span>18763369</span>
                            </td>
                            <td>
                                <figure>
                                    <img src="{{asset('uploads/api/images/'.$response->userQuestion->image)}}" alt="uder image">
                                </figure>
                            </td>
                            <td>{{$response->userQuestion->name}}</td>
                            <td>{{$response->userQuestion->account_type}}</td>
                            <td>{{(auth()->user()->name)}}</td>
                            <td>
                                <a href="javascript: void(0);" class="at-btneyeicons">
                                    <i class="icon-eye" data-id = "{{$response->id}}"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
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
        $(document).ready(function() {
            $(document).on('click','.icon-eye',function(e){
                let id = $(this).data('id');
                console.log(id)
                $.get('/superadmin/response/questionnaire/detail/'+id,function (response) {
                    $('.questionnaire_detail').html(response)
                })
            });
        });
    </script>
    @endsection
