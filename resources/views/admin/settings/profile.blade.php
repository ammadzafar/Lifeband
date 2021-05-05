@extends('layouts.admin')
@section('title'.'Life Band Settings')
@section('content')
   <div class="at-settings">
       <div class="at-content">
           <div class="at-pagetitle">
               <h2>settings</h2>
           </div>
           <div class="at-settingarea">
               <div class="at-settinghead">
                   <h3>profile</h3>
               </div>
               <div class="at-settingcontent">
                   <figure class="at-seetinguserimg">
                       @if(auth()->user()->image)
                           <img src="{{asset('uploads/api/images/'.auth()->user()->image)}}" alt="user image">
                       @else
                           <i class="icon-upload"></i>
                       @endif
                   </figure>
                   <div class="at-settinguserdetail">
                       <div class="at-settingleftarea">
                           <span>first name</span>
                           <h4>{{$user->name}}</h4>
                       </div>
                       <div class="at-useremail">
                           <span>email</span>
                           <h4>{{$user->email}}</h4>
                       </div>
                   </div>
                   <div class="at-settingbtnholder">
                       <ul>
                           <li>
                               <a href="{{route('admin.settings.edit',['id'=>$user->id])}}" class="at-btn at-bggreen">edit profile</a>
                           </li>
                           <li>
                               <a href="{{route('admin.settings.change.password',['id'=>$user->id])}}" class="at-btn at-bggreen">change password</a>
                           </li>
                       </ul>
                   </div>
               </div>
           </div>
       </div>
   </div>
@endsection


