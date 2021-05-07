@extends('layouts.core')
@section("page-name", trans("setup.Users"))
@section("breadcrumb")
    <div class="d-flex align-items-center flex-wrap mr-1">
        <!--begin::Page Heading-->
        <div class="d-flex align-items-baseline flex-wrap mr-5">
            <!--begin::Page Title-->
            <h5 class="text-dark font-weight-bold my-1 mr-5">@lang('users.Users')</h5>
            <!--end::Page Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                <li class="breadcrumb-item text-muted">
                    <a href="{{route("dashboard")}}" class="text-muted">@lang('modules.Dashboard')</a>
                </li>
                <li class="breadcrumb-item text-muted">
                    <a class="text-muted">@lang('users.Users Roles')</a>
                </li>
                <li class="breadcrumb-item text-muted">
                    <a href="" class="text-muted">@lang('users.Create New Role')</a>
                </li>
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page Heading-->
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 ">
            {!! Form::open(['route' => 'roles.store', "class"=>"kt-form", 'id'=> 'kt_form', 'enctype'=>"multipart/form-data"]) !!}
            <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper float-right">
                            <a href="{{route('roles.index')}}" class="kt-margin-r-5">
                                <span class=" kt-hidden-mobile btn btn-secondary btn-hover-brand"><i class="la la-arrow-left"></i>Back</span>
                            </a>
                            <div class="btn-group">
                                {!! Form::button('<i class="fa fa-save"></i> Save', ['type'=>'submit', 'class' =>'btn
                                btn-info save']) !!}
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="kt-portlet__body justify-content-center">
                    <div class="row justify-content-center">
                        <div class="col-xl-12">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <div class="form-group">
                                        @include('users::roles.fields')
                                        <div class="form-group form-group-last row"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
