<!-- Password Field -->
<div class="form-group col-md-6 col-12">
    {!! Form::label('password', 'Password *:') !!}
    @if($errors->first('password'))
        <small class="text-danger">{{$errors->first('password')}}</small>
    @endif
    {!! Form::password('password', [
            'class' => 'form-control',
            'required'=>($action == 'create')?true:false,
            "placeholder" => 'Password',
            'max' => 255,
            "min" => 3,
            "autocomplete" => "new-password",
            "value" => ""
        ])
    !!}
</div>
<!-- Password Field -->
<div class="form-group col-md-6 col-12">
    {!! Form::label('password_confirmation', 'Confirm User Password *:') !!}
    @if($errors->first('password_confirmation'))
        <small class="text-danger">{{$errors->first('password_confirmation')}}</small>
    @endif
    {!! Form::password('password_confirmation', [
            'class' => 'form-control',
            'required'=>($action == 'create')?true:false,
            "placeholder" => 'Confirm User Password',
            'max' => 255,
            "min" => 3,
        ])
    !!}
</div>

