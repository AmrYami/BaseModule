<div class="row my-2">
    <div class="card card-custom card-stretch gutter-b example example-compact  py-2">
        <div class="col-12">
            <div class="form-group">
                <label> @lang('forms.name') @lang('common.inEn')</label>
                <input @if(isset($role->id) && in_array($role->id , [1,2,3,4])) readonly @endif type="text" name='name' class="form-control" placeholder="@lang('forms.name')" value="{{ $role->name??(old('name')??'') }}" autocomplete="off" required>
            </div>
        </div>
    </div>
</div>

@foreach($allPermissions->groupBy('permission_group') as $groupName => $groupPermissions )
    @if(($loop->iteration) % 2 != 0  )
        <div class="row justify-content-center">
            @endif
            <div class="col-5 m-5">
                <div class="row card card-custom card-stretch gutter-b example example-compact">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label"> {{trans(ucwords(str_replace('-', ' ', $groupName)).' Module')}}</h3>
                        </div>
                        <div class="card-toolbar">
                            <label class="form-check form-check-custom form-check-solid me-9">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#{{Str::slug($groupName, '_')}} .form-check-input" value="1">	<span class="form-check-label" for="kt_roles_select_all">@lang('common.selectAll')</span>
                            </label>
                        </div>
                    </div>
                    <div class="card-body" id="{{Str::slug($groupName, '_')}}">
                    @foreach($groupPermissions as $permission)
                        <!--begin::Checkbox-->
                            @can($permission->name)
                                <label class="form-check form-check-sm form-check-custom form-check-solid mb-1 ">
                                    <input class="form-check-input" type="checkbox" value="{{$permission->id}}" name="selected[]"  @if(isset($role) && $role->hasPermissionTo($permission->name)) checked @endif />
                                    <span class="form-check-label" data-toggle="tooltip" data-placement="right" title="Tooltip on right">{{app()->getLocale() == 'ar' ? $permission->ar_display_name : $permission->display_name}}</span>
                                </label>
                                <!--end::Checkbox-->
                            @endcan
                        @endforeach
                    </div>
                </div>
            </div>
            @if(($loop->iteration +1) % 2 != 0  && $loop->remaining != 0)
        </div>
        @elseif($loop->remaining == 0)
        </div>
    @endif
@endforeach

@push('js')

    <script src="{{asset('assets/js/roles/list/add.js')}}"></script>
    {{--		<script src="{{asset('assets/js/custom/apps/user-management/roles/list/update-role.js')}}"></script>--}}
@endpush
