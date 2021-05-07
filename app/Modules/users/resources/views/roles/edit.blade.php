@extends('layouts.core')
@section("page-name", trans("setup.Roles"))
@section("breadcrumb")
    <div class="c-subheader justify-content-between px-3">
        <!-- Breadcrumb-->
        <ol class="breadcrumb border-0 m-0 px-0 px-md-3">
            <li class="breadcrumb-item">{{trans("setup.Home")}}</li>
            <li class="breadcrumb-item">{{trans("setup.Admin")}}</li>
            <li class="breadcrumb-item active">{{trans("setup.Roles")}}</li>
            <li class="breadcrumb-item active">{{trans("setup.Edit")}}</li>
            <!-- Breadcrumb Menu-->
        </ol>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">


                {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' =>'put', 'autocomplete' => 'off', 'enctype'=>"multipart/form-data"]) !!}
                <div class="card-header"><strong>{{trans("setup.Edit")}}</strong>
                    <div class="kt-portlet__head-toolbar float-right">
                        <div class="kt-portlet__head-wrapper">
                            <a href="{{route('roles.index')}}" class="kt-margin-r-5">
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

                    @include('users::roles.fields')
                </div>

                {!! Form::close() !!}







            </div>
        </div>
        <!-- /.col-->
    </div>
@endsection
