<!-- Name Field -->
<div class="form-group col-md-12 col-12">
    {!! Form::label('name', 'Role Name *:') !!}
    @if($errors->first('name'))
        <small class="text-danger">{{$errors->first('name')}}</small>
    @endif
    {!! Form::text('name', null,
        [
            'class' => 'form-control',
            'required'=>true,
            "placeholder" => 'Role Name',
            'max' => 255,
            "min" => 3,
        ])
    !!}
    @if ($errors->has('name'))
        <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
    @endif
</div>
<div class="checkbox">
    <label style="color:red"><input type="checkbox"
                                    name="all" id="all"
        >@lang('users.All Permission')</label>
</div>
@if(!empty($MGTPermissiond = $allPermissions->where('permission_group','top-mgt')->pluck('display_name','id')->toArray()))
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">@lang('users.Top MGT')</h3>

                        </div>
                        <div class="card-body">
                            <!--begin::Form-->
                                <div class="form-group">
                                    <div class="checkbox-list">

                                        @foreach($MGTPermissiond as $key => $value)
                                            <div class="form-check checkbox">
{{--                                                {{ Form::checkbox('selected[]', $key,$selected[$key]?? null, ['class' => 'form-check-input']) }}--}}
{{--                                                {!! Form::label('selected', $value,['class' => 'form-check-label' ]) !!}--}}
                                            </div>
                                            <label class="checkbox">
                                                {{ Form::checkbox('selected[]', $key,$selected[$key]?? null) }}
                                                <span></span>{{$value}}</label>
                                        @endforeach

                                    </div>
                                </div>
                            <!--end::Form-->
                        </div>
                    </div>
                    <!--end::Card-->
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->

    {{--                    {!! Form::select('top_mgt[]', $allPermissions->where('permission_group','top-mgt')->pluck('display_name','id')->toArray(),--}}
    {{--                    isset($role)&&!empty($rolePermissions->where('permission_group','top-mgt'))?$rolePermissions->where--}}
    {{--                    ('permission_group','top-mgt'):null,--}}
    {{--                        [--}}
    {{--                            'data-available-title'=>'Available Permissions',--}}
    {{--                            'data-selected-title'=>'Selected Permissions',--}}
    {{--                            'class' => 'kt-dual-listbox',--}}
    {{--                            'multiple'=>'true',--}}
    {{--                            'id'=>'kt-dual-listbox-1',--}}
    {{--                        ])--}}
    {{--                    !!}--}}

@endif
<div class="row">

    @if(!empty($allPermissions->where('permission_group','modules-settings')->pluck('display_name','id')->toArray()))
        <div class="col-md-6 col-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head row justify-content-center">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Modules Settings
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    {!! Form::select('modules_settings[]', $allPermissions->where('permission_group','modules-settings')->pluck
                    ('display_name','id')->toArray(),
                    isset($role)&&!empty($rolePermissions->where('permission_group','modules-settings'))
                    ?$rolePermissions->where('permission_group','modules-settings'):null,
                        [
                            'data-available-title'=>'Available Permissions',
                            'data-selected-title'=>'Selected Permissions',
                            'class' => 'kt-dual-listbox',
                            'multiple'=>'true',
                            'id'=>'kt-dual-listbox-1',
                        ])
                    !!}
                </div>
            </div>
        </div>
    @endif
    {{--	</div>--}}
    {{--	<div class="row">--}}
    @if(!empty($allPermissions->where('permission_group','setup')->pluck('display_name','id')->toArray()))
        <div class="col-md-6 col-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head row justify-content-center">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Setup
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    {!! Form::select('setup[]', $allPermissions->where('permission_group','setup')->pluck('display_name','id')->toArray(),
                    isset($role)&&!empty($rolePermissions->where('permission_group','setup'))?$rolePermissions->where
                    ('permission_group','setup'):null,
                        [
                            'data-available-title'=>'Available Permissions',
                            'data-selected-title'=>'Selected Permissions',
                            'class' => 'kt-dual-listbox',
                            'multiple'=>'true',
                            'id'=>'kt-dual-listbox-1',
                        ])
                    !!}
                </div>
            </div>
        </div>
    @endif
    @if(!empty($allPermissions->where('permission_group','general')->pluck('display_name','id')->toArray()))
        <div class="col-md-6 col-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head row justify-content-center">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            General
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    {!! Form::select('general[]', $allPermissions->where('permission_group','general')->pluck('display_name','id')->toArray(),isset($role)&&!empty($rolePermissions->where('permission_group','general'))?$rolePermissions->where('permission_group','general'):null,
                        [
                            'data-available-title'=>'Available Permissions',
                            'data-selected-title'=>'Selected Permissions',
                            'class' => 'kt-dual-listbox',
                            'multiple'=>'true',
                            'id'=>'kt-dual-listbox-1',
                        ])
                    !!}
                </div>
            </div>
        </div>
    @endif
</div>
{{--{!! Form::select('selected[]',isset($selected)&&!empty($selected)?$selected->pluck('display_name','id')->toArray():[],isset($selected)&&!empty($selected)?$selected:null,--}}
{{--    [--}}
{{--        'hidden'=>false,--}}
{{--        'multiple'=>'true',--}}
{{--        'hidden'=>true,--}}
{{--        'id' => 'selected',--}}
{{--    ])--}}
{{--!!}--}}



@push('js')
    <script>
        $('#all').change(function () {
            var checkboxes = $(this).closest('form').find(':checkbox');
            if ($(this).is(':checked')) {
                checkboxes.prop('checked', true);
            } else {
                checkboxes.prop('checked', false);
            }
        });
    </script>
@endpush
