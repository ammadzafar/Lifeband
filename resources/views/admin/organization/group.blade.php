@extends('layouts.admin')
@section('title','Life Band Groups')
@section('content')
    <main id="at-main" class="at-main at-haslayout">
        <div class="at-dashboard at-users at-questionnaier at-groups">
            <div class="at-content">
                <div class="at-userscontent at-questionnaiercontent">
                    <div class="at-usershead">
                        <div class="at-pagetitle">
                            <h2>groups</h2>
                        </div>
                        <div class="at-btnholder">
                            <a href="javascript:void(0);" class="at-btn at-bggreen" data-toggle="modal" data-target="#exampleModalCentervfive">create group</a>
                        </div>
                    </div>
                </div>
                <div class="at-responsecontent at-grouptable">
                    <table class="at-tabletheme at-responsetable">
                        <thead>
                        <tr>
                            <th>serial</th>
                            <th>group picture</th>
                            <th>group name</th>
                            <th>group  members</th>
                            <th>action</th>
                            <th>assign Questionnaire</th>
                        </tr>
                        </thead>
                        <tbody>
{{--                        {{dd($users)}}--}}
                        @foreach($group_users as $user)
                        <tr>
                            <td>
                                <span>18763369</span>
                            </td>
                            <td>
                                <figure>
                                    <img src="{{asset('uploads/group/'.$user->image)}}" alt="uder image">
                                </figure>
                            </td>
                            <td>{{$user->name}}</td>
                            <td>
                                <div class="at-groupmemebers">
                                    <ul>
                                        @foreach($user->users->take(2) as $key =>  $u)
                                          <li>
                                              <span><img src="{{asset('uploads/group/'.$u->group->image)}}" alt="uder image"></span>
                                          </li>
                                        @endforeach
                                          <li>
                                              <span>+{{count($users)}}</span>
                                          </li>

                                    </ul>
                                </div>
                            </td>
                            <td>
                                <div class="at-editdeletebtnholder">
                                    <a href="javascript: void(0);" class="pen-icon" data-id="{{$user->id}}" {{--data-toggle="modal" data-target="#exampleModalCentervfive"--}}>
                                        <i class="icon-pen"></i>
                                    </a>
                                    <form action="{{route('users.group.delete',['id'=>$user->id])}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" ><i class="icon-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
											<span class="at-checkbox">
												<input type="checkbox" id="at-checkboxone">
												<label for="at-checkboxone"></label>
											</span>
                                </div>
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
           add group modal End
   *************************************-->
    <div class="modal fade at-modaltheme at-userinfomodal at-addgroupmodal" id="exampleModalCentervfive" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body group-data">
                @include('admin.organization.group-modal')
                </div>
            </div>
        </div>
    </div>
    <!--************************************
            Modal End
    *************************************-->
    @endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $(document).on('change', '#at-uploadlogo', function (e) {
                let image_src = $('.group-image').attr('src', URL.createObjectURL(e.target.files[0]));
                if (image_src != null) {
                    $('.icon-upload').css({'display': 'none'});
                    $('.group-image').css({'display': 'block'});
                }
            });
            $(document).on('click','.pen-icon',function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $.get('/group/edit/'+id, function(response){
                    $('#exampleModalCentervfive').modal('show');
                    $('.group-data').html(response);

                })
            });
            $('#exampleModalCentervfive').on('hidden.bs.modal',function (e){

                $(this).find('.at-formtheme .group-image').attr('src','');
                $(this).find('.at-formtheme .group-name').val("");
                $(this).find('.at-formtheme .checkbox').prop("checked", false);
            })
        });
    </script>
    @endsection
