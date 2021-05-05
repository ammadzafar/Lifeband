@extends('layouts.admin')
@section('title','Life Band Family Accounts')
@section('content')
    <!--************************************
				Main Start
		*************************************-->
    <main id="at-main" class="at-main at-haslayout">
        <div class="at-dashboard at-organization at-familyaccount">
            <div class="at-content">
                <div class="at-organizationcontent at-familycontent">
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
                        @if(count($families) > 1)
                            <h2>{{count($families)}} Accounts found</h2>
                        @else
                            <h2>{{count($families)}} Account found</h2>
                        @endif
                        @if(auth()->user()->isAdmin())
                            <a href="javascript: void(0);" class="at-btn" data-toggle="modal" data-target="#familyModal">Add Family</a>
                        @endif
                    </div>
                    <div class="at-organizationholder at-familyholder">
                        @foreach($families as $family)
                        <div class="at-organizer">
                            <figure class="at-orgnizerimg">
                                <img src="{{asset('uploads/family/images/'.$family->image)}}" alt="family image">
                            </figure>
                            <div class="at-orgnizertitle">
                                <h3>{{auth()->user()->name}}</h3>
                                <span>{{$family->admin_name}}</span>
                            </div>
                            <div class="at-organizeband">
                                <h4>{{$family->bands}}</h4>
                            </div>
                            <div class="at-action">
                                <h4>actions</h4>
                                <ul>
                                    <li>
                                        <a href="#" class="at-btnpen" data-id="{{$family->id}}">
                                            <i class="icon-pen"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{route('family.accounts.delete',['id'=>$family->id])}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="at-btndelete"><i class="icon-trash"></i></button>
                                        </form>
                                    </li>
                                    <li>
                                        @if(auth()->user()->isAdmin())
                                            <a href="{{route('family.accounts.dashboard',['id'=>$family->id])}}" class="at-btnshare">
                                        @elseif(auth()->user()->isFamilyAccountant())
                                            <a href="{{route('family.admin.dashboard',['id'=>$family->id])}}" class="at-btnshare">
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
    <div class="modal fade at-modaltheme at-creatorgnizermodal" id="familyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add family</h5>
                </div>
                <div class="modal-body family-account-data">
                   @include('admin.family-accounts.modal')
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
                $('#exampleModalLongTitle').text('Edit Family');
                let id = $(this).data('id');
                $.get('/superadmin/family-accounts/edit/'+id, function(response){
                    $('#familyModal').modal('show');
                    $('.family-account-data').html(response);

                })
            });
            $('#familyModal').on('hidden.bs.modal',function (e){

                $('#exampleModalLongTitle').text('Add Family');
                $(this).find('.at-formtheme .org-image').attr('src','');
                $(this).find('.at-formtheme .org-name').val("");
                $(this).find('.at-formtheme .org-category').val("");
                $(this).find('.at-formtheme .org-email').val("");
                $(this).find('.at-formtheme .org-band').val("");
                $(this).find('.at-formtheme .org-category').val("");
            });

            $(document).on('click','.at-btnsubmit',function () {

                if ($('.org-image').attr('src') == ''){
                    $('.image-error').text('** Please Upload Image');
                    $('.image-error').css({'color':'#ff5a5f'});
                    return false;
                }else if ($('.family-name').val() == ''){
                    $('.name-error').text('** Please Provide Family Admin Name ');
                    $('.name-error').css({'color':'#ff5a5f'});
                    return false;
                }else if ($('.contact').val() == ''){
                    $('.contact-error').text('** Please Provide Your Contact');
                    $('.contact-error').css({'color':'#ff5a5f'});
                    return false;
                }else if ($('.fam-email').val() == ''){
                    $('.email-error').text('** Please Provide Your Valid Email');
                    $('.email-error').css({'color':'#ff5a5f'});
                    return false;
                }else if ($('.fam-bands').val() == ''){
                    $('.band-error').text('** Band Feild is Empty');
                    $('.band-error').css({'color':'#ff5a5f'});
                    return false;
                }else if ($('.emg-contact').val() == ''){
                    $('.emergency-contact-error').text('** Emergency Contact Number is Required');
                    $('.emergency-contact-error').css({'color':'#ff5a5f'});
                    return false;
                }
                return true;
            });
            $(document).on('input','input',function(){
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
