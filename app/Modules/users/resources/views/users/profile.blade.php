@extends('layouts.core')
@section("page-name", trans("modules.My Profile"))
@section("breadcrumb")
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <a href="{{route("dashboard")}}" class="kt-subheader__breadcrumbs-link">@lang('modules.Dashboard')</a>
    <span class="kt-subheader__breadcrumbs-separator"></span>
    <span
        class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">@lang('modules.My Profile')</span>
@endsection
@section('content')


    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="nav-tabs-boxed">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home-1" role="tab"
                                            aria-controls="home">My Profile</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile-1" role="tab"
                                            aria-controls="profile">@lang('profile.Edit Profile')</a></li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#messages-1" role="tab"
                           aria-controls="messages">@lang('profile.Edit Password')</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="home-1" role="tabpanel">
                        <div class="card">
                            <div class="card-header">@lang('modules.My Profile')</div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        {{--                                        <th></th>--}}
                                        {{--                                        <th></th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <p><code class="highlighter-rouge">Image</code></p>
                                        </td>
                                        <td><span>
                                                @if (count(Auth::user()->getMedia('avatar')) > 0)
                                                    @foreach(Auth::user()->getMedia('avatar') as $file)
                                                        <img alt="Preview Image 1" class="w-25 p-3"
                                                             src="{{asset('storage/'.$file->id.'/'.$file->file_name)}}"
                                                             data-image="{{asset('storage/'.$file->id.'/'.$file->file_name)}}"
                                                             data-description="">
                                                    @endforeach
                                                @else
                                                    <img alt="Pic" src="{{asset("assets/media/users/default.jpg")}}"/>
                                                @endif

                                            </span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><code class="highlighter-rouge">Name:</code></p>
                                        </td>
                                        <td><span class="h2">{{ Auth::user()->name }}</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><code class="highlighter-rouge">Email:</code></p>
                                        </td>
                                        <td><span class="h2">{{ Auth::user()->email }}</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><code class="highlighter-rouge">Mobile:</code></p>
                                        </td>
                                        <td><span class="h3">{{ Auth::user()->mobile??'' }}</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><code class="highlighter-rouge">Role:</code></p>
                                        </td>
                                        {{--                                        <td><span class="h3">{{ Auth::user()->roleName() }}</span></td>--}}
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="profile-1" role="tabpanel">

                        {!! Form::model(Auth::user()  , ['route' => ['my_profile.update', Auth::user()->id], 'method' =>'post', 'enctype'=>"multipart/form-data"]) !!}
                        <div class="card-header"><strong>{{trans("setup.Edit")}}</strong>
                            <div class="kt-portlet__head-toolbar float-right">
                                <div class="kt-portlet__head-wrapper">
                                    {{--                                    <a href="{{route('users.index')}}" class="kt-margin-r-5">--}}
                                    {{--                                <span class=" kt-hidden-mobile btn btn-secondary btn-hover-brand"><i--}}
                                    {{--                                        class="la la-arrow-left"></i>Back</span>--}}
                                    {{--                                    </a>--}}
                                    <div class="btn-group">
                                        {!! Form::button('<i class="fa fa-save"></i> Save', ['type'=>'submit', 'class' =>'btn  btn-info']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        @include('users::users.fields')

                    <!-- Avatar Field -->
                        <div class="form-group col-md-6 col-12">
                            {!! Form::label('avatar', 'Avatar:') !!}
                            @if($errors->first('avatar'))
                                <br>
                                <small class="text-danger">{{$errors->first('avatar')}}</small>
                            @endif
                            <div class="custom-file">
                                {!! Form::file('avatar', ['class' => 'form-control custom-file-input']) !!}
                                {!! Form::label('avatar', (isset($user) && !empty($user->getMedia('avatar')[0]['file_name'])) ? $user->getMedia('avatar')[0]['file_name'] : "Choose File :", ["class" =>"custom-file-label", 'style' => 'overflow:hidden;word-break:break-all;']) !!}
                            </div>
                        </div>

                        {!! Form::close() !!}

                    </div>
                    <div class="tab-pane" id="messages-1" role="tabpanel">
                        {!! Form::model($user, ['route' => ['users.update_password', $user->id], 'method' =>'put', 'autocomplete' => 'off']) !!}
                        <div class="card-header"><strong>{{trans("setup.Edit Password")}}</strong>
                            <div class="kt-portlet__head-toolbar float-right">
                                <div class="kt-portlet__head-wrapper">
                                    <a href="{{route('users.index')}}" class="kt-margin-r-5">
                                <span class=" kt-hidden-mobile btn btn-secondary btn-hover-brand"><i
                                        class="la la-arrow-left"></i>Back</span>
                                    </a>
                                    <div class="btn-group">
                                        {!! Form::button('<i class="fa fa-save"></i> Save', ['type'=>'submit', 'class' =>'btn  btn-info']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('users::users.fields_password')
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

