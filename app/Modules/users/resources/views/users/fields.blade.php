<!-- Name Field -->
<div class="form-group col-md-6 col-12">
    {!! Form::label('name', 'Full Name *:') !!}
    @if($errors->first('name'))
        <small class="text-danger">{{$errors->first('name')}}</small>
    @endif
    {!! Form::text('name', null,
        [
            'class' => 'form-control',
            'required'=>true,
            "placeholder" => 'User Name',
            'max' => 255,
            "min" => 3,
            "autocomplete" => "off"
        ])
    !!}
    @if ($errors->has('name'))
        <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
    @endif
</div>
<!-- Mail Field -->
<div class="form-group col-md-6 col-12">
    {!! Form::label('email', 'Email *:') !!}
    {!! Form::email('email', null,
        [
            'class' => 'form-control',
            'required'=>true,
            "pattern"=>"^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$",
            "placeholder" => 'Email',
            'max' => 255,
            "min" => 3,
            "autocomplete" => "off"
        ])
    !!}
    @if ($errors->has('email'))
        <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
    @endif
</div>
@if(isset($profile))
<div class="form-group col-md-6 col-12">
    {!! Form::label('status', 'Status *:') !!}
    @if($errors->first('status'))
        <br>
        <small class="text-danger">{{$errors->first('status')}}</small>
    @endif
    {!! Form::select('status',  [Null=>__('select')]+$status, null,
        [
            'class' => 'form-control',
            'name'=>'status',
            'id'=>'exampleSelectd',
            'required'=>true,
        ])
    !!}
</div>
@endif
<!-- Mobile Field -->
<div class="form-group col-md-6 col-12">
    {!! Form::label('mobile', 'Mobile:') !!}
    @if($errors->first('mobile'))
        <br>
        <small class="text-danger">{{$errors->first('mobile')}}</small>
    @endif
    {!! Form::text('mobile', null,
    [
        'class' => 'form-control',
        'required'=>false,
        "pattern"=>"^[0-9]+",
        "placeholder" => 'Mobile',
        'max' => 16,
        "min" => 5,
    ])
!!}
    @if ($errors->has('mobile'))
        <span class="help-block">
                        <strong>{{ $errors->first('mobile') }}</strong>
                    </span>
    @endif
</div>

