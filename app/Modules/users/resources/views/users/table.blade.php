<!--begin: Datatable-->
<table class="table table-separate table-head-custom" id="kt_datatable">
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        {{--                                    <th>Type</th>--}}
        <th>Role</th>
        @canany(['edit-users','block-users', 'delete-users'])
            <th>{{trans("modules.Action")}}</th>
        @endcanany
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->mobile }}</td>
            {{--                    <td>{{ $user->type }}</td>--}}
            {{--                        <td>{{ ucfirst($user->type) }}</td>--}}
            <td>{{ implode(',', $user->roles->pluck('name')->toArray()) }}</td>
            @canany(['edit-users','block-users', 'delete-users'])
                {{--                            @if($flag ?? '')--}}
                {{--                                <td>--}}
                {{--                                    <div class='btn-group'>--}}
                {{--                                        @can('edit-users')--}}
                {{--                                            <a href="{{ route('users.restore', [$user->id]) }}"--}}
                {{--                                               class='btn btn-default btn-xs'><i class="fas fa-trash-restore"></i></a>--}}
                {{--                                        @endcan--}}
                {{--                                    </div>--}}
                {{--                                </td>--}}
                {{--                            @endif--}}
                <td>
                    @if($user->id != 1)
                    <div class='btn-group'>
                        @can('edit-users')
                            <a href="{{ route('users.edit', [$user->id]) }}"
                               class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>
                        @endcan
                        @can("delete-users")
                            {!! Form::open(['route' => ['users.destroy', $user->id], 'method'
                            => 'delete', 'class' =>'d-inline-block']) !!}
                            {!! Form::button('<i class="fa fa-trash"></i>',
                                ['type' => 'submit', 'class' => 'btn btn-danger btn-xs',
                                'onclick' => "return confirm('Are you sure you woant to delete this user?')"]) !!}
                            {!! Form::close() !!}
                            @if($user->freeze == 0)
                                {!! Form::open(['route' => ['users.freeze', $user->id], 'method'
                                => 'PUT', 'class' =>'d-inline-block']) !!}
                                {!! Form::button('Freeze',
                                    ['type' => 'submit', 'class' => 'btn btn-danger btn-xs',
                                    'onclick' => "return confirm('Are you sure you woant to freeze this user?')"]) !!}
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['route' => ['users.un_freeze', $user->id], 'method'
                                    => 'PUT', 'class' =>'d-inline-block']) !!}
                                {!! Form::button('Un-Freeze',
                                        ['type' => 'submit', 'class' => 'btn btn-danger btn-xs',
                                        'onclick' => "return confirm('Are you sure you woant to un-freeze this user?')"]) !!}
                                {!! Form::close() !!}
                            @endif
                            {{--                                    {!! Form::open(['route' => ['users.banned_until', $user->id], 'method'--}}
                            {{--                                    => 'PUT', 'class' =>'d-inline-block']) !!}--}}
                            {{--                                    {!! Form::button('Banned Until',--}}
                            {{--                                        ['type' => 'submit', 'class' => 'btn btn-danger btn-xs',--}}
                            {{--                                        'onclick' => "return confirm('Are you sure you woant to freeze this user?')"]) !!}--}}
                            {{--                                    {!! Form::close() !!}--}}
                        @endcan
                    </div>
                    @endif
                </td>
            @endcanany
        </tr>
    @endforeach
    </tbody>
</table>
<!--end: Datatable-->
<!--end::Card-->
