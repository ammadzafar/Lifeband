@extends('layouts.admin')
@section('title','Life Band Organization')
@section('content')
    <!--************************************
				Main Start
		*************************************-->
    <main id="at-main" class="at-main at-haslayout">
        <div class="at-dashboard at-organization">
            <div class="at-content">
                <div class="at-organizationcontent">
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
                    <div class="at-pagetitle">
                        @if(count($organizations) > 1)
                        <h2>{{count($organizations)}} organizations found</h2>
                        @else
                            <h2>{{count($organizations)}} organization found</h2>
                        @endif
                        @if(auth()->user()->isAdmin())
                            <a href="javascript: void(0);" class="at-btn add-btn" data-toggle="modal" data-target="#organizationModal">Add Organization</a>
                        @endif
                    </div>
                    <div class="at-organizationholder">
                        @foreach($organizations as $org)
                        <div class="at-organizer">
                            <figure class="at-orgnizerimg">
                                <img src="{{asset('uploads/organization/logos/'.$org->image)}}" alt="orgnizer image">
                            </figure>
                            <div class="at-orgnizertitle">
                                <h3>{{$org->name}}</h3>
                                <span>{{$org->category}}</span>
                            </div>
                            <div class="at-organizeband">
                                <h4>{{$org->bands}} Bands Package</h4>
                                <span>Resource Person: {{auth()->user()->name}}</span>
                            </div>
                            <div class="at-action">
                                <h4>actions</h4>
                                <ul>
                                    <li>
                                        <a href="#" class="at-btnpen" data-id="{{$org->id}}" {{--data-toggle="modal" data-target="#exampleModalCenter"--}}>
                                            <i class="icon-pen"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{route('organization.delete',['id'=>$org->id])}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="at-btndelete"><i class="icon-trash"></i></button>
                                        </form>
                                    </li>
                                    <li>
                                       @if(auth()->user()->isAdmin())
                                            <a href="{{route('organization.dashboard',['id'=>$org->id])}}" class="at-btnshare">
                                       @elseif(auth()->user()->isOrganizer())
                                            <a href="{{route('organization.admin.dashboard',['id'=>$org->id])}}" class="at-btnshare">
                                       @endif
                                            <i class="icon-share"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
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
    <!--************************************
			Modal Start
	*************************************-->
    <div class="modal fade at-modaltheme at-creatorgnizermodal at-creatorgnizermodalvtwo" id="organizationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLongTitle">Add organization</h5>
                </div>
                <div class="modal-body organization_data">
                    @include('admin.organization.modal')
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
            $(document).on('change','#at-uploadlogo',function(e) {
                let image_src = $('.org-image').attr('src', URL.createObjectURL(e.target.files[0]));
                if (image_src != null)
                {
                    $('.icon-upload').css({'display':'none'});
                    $('.org-image').css({'display':'block'});
                }
            });
            $(document).on('click','.at-btnpen',function(e) {
                e.preventDefault();
                $('#exampleModalLongTitle').text('Edit organization');
                let id = $(this).data('id');
                $.get('/superadmin/organization/edit/'+id, function(response){
                $('#organizationModal').modal('show');
                $('.organization_data').html(response);
                })
            });
            $('#organizationModal').on('hidden.bs.modal',function (e){

                $('#exampleModalLongTitle').text('Add organization');
                $(this).find('.at-formtheme .org-image').attr('src','');
                $(this).find('.at-formtheme .org-name').val("");
                $(this).find('.at-formtheme .org-category').val("");
                $(this).find('.at-formtheme .org-email').val("");
                $(this).find('.at-formtheme .org-band').val("");
                $(this).find('.at-formtheme .org-category').val("");
            });

            $(document).on('click','.at-btnsubmit',function () {

                if ($('.org-image').attr('src') == ''){
                    $('.image-error').text('** Please Upload Organization Image');
                    $('.image-error').css({'color':'#ff5a5f'});
                    return false;
                }else if ($('.org-name').val() == ''){
                    $('.name-error').text('** Organization Name Must Be Filled');
                    $('.name-error').css({'color':'#ff5a5f'});
                    return false;
                }else if ($('.org-category').val() == ''){
                    $('.category-error').text('** Category Name Must Be Filled');
                    $('.category-error').css({'color':'#ff5a5f'});
                    return false;
                }else if ($('.org-email').val() == ''){
                    $('.email-error').text('** Please Provide Your Valid Email');
                    $('.email-error').css({'color':'#ff5a5f'});
                    return false;
                }else if ($('.org-band').val() == ''){
                    $('.band-error').text('** Band Feild is Empty');
                    $('.band-error').css({'color':'#ff5a5f'});
                    return false;
                }else if ($('.org-admin').val() == ''){
                    $('.admin-error').text('** Organization Admin Name is Required');
                    $('.admin-error').css({'color':'#ff5a5f'});
                    return false;
                }
                return true;
            });
            $(document).on('input','input',function(){
                $(this).siblings('.at-error').hide();
                if ($(this).val() == ''){
                    $(this).siblings('.at-error').show();
                }else{
                    $(this).siblings('.at-error').hide();
                }
            });
            $(document).on('click','input:file',function () {
                if ($(this).val() == ''){
                    $(this).siblings('.at-error').show();
                }else{
                    $(this).siblings('.at-error').hide();
                }
            });
        });
    </script>
@endsection

