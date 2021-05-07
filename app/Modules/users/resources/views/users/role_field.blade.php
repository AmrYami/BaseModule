<div class="form-group col-md-6 col-12">
    {!! Form::label('role', 'Role *:') !!}
    @if($errors->first('role'))
        <br>
        <small class="text-danger">{{$errors->first('role')}}</small>
    @endif
    {!! Form::select('role',  [Null=>__('select')]+$roles, (isset($user)&&!empty($user->roles->first()->id))?$user->roles->first()->id:"",
        [
            'class' => 'form-control',
            'name'=>'role',
            'id'=>'exampleSelectd',
            'required'=>true,
        ])
    !!}
</div>
