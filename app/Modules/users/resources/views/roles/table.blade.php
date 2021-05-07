<!--begin: Datatable-->
<table class="table table-separate table-head-custom" id="kt_datatable">
    <thead>
    <tr>
        <th>Name</th>
        @canany(['edit-users-role','delete-users-role'])
            <th>Action</th>
        @endcanany
    </tr>
    </thead>
    <tbody>
    @foreach($roles as $role)
        <tr>
            <td>{{ $role->name }}</td>
            @canany(['edit-users-role','delete-users-role'])
                <td>
                    @if($role->id != 1)
                        <div class='btn-group'>
                            @can('edit-users-role')
                                <a href="{{ route('roles.edit', [$role->id]) }}"
                                   class='btn btn-default btn-xs'><i class="fa fa-edit"></i></a>
                            @endcan
                            @can('delete-users-role')
                                {!! Form::open(['route' => ['roles.destroy', $role->id], 'method'
                                => 'delete', 'class' =>'d-inline-block']) !!}
                                {!! Form::button('<i class="fa fa-trash"></i>',
                                    ['type' => 'submit', 'class' => 'btn btn-danger btn-xs',
                                    'onclick' => "return confirm('Are you sure you woant to delete this user?')"]) !!}
                                {!! Form::close() !!}
                            @endcan
                        </div>
                    @endif
                </td>
            @endcanany
        </tr>
    @endforeach
    </tbody>
</table>
