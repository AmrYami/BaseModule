<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $campaign->name }}</p>
</div>

<!-- Content Field -->
<div class="form-group">
    {!! Form::label('content', 'Content:') !!}
    <p>{{ $campaign->content }}</p>
</div>

<!-- Purpose Field -->
<div class="form-group">
    {!! Form::label('purpose', 'Purpose:') !!}
    <p>{{ $campaign->purpose }}</p>
</div>

<!-- From Field -->
<div class="form-group">
    {!! Form::label('from', 'From:') !!}
    <p>{{ $campaign->from }}</p>
</div>

<!-- To Field -->
<div class="form-group">
    {!! Form::label('to', 'To:') !!}
    <p>{{ $campaign->to }}</p>
</div>

<!-- Budget Field -->
<div class="form-group">
    {!! Form::label('budget', 'Budget:') !!}
    <p>{{ $campaign->budget }}</p>
</div>

<!-- Targer Field -->
<div class="form-group">
    {!! Form::label('targer', 'Targer:') !!}
    <p>{{ $campaign->targer }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $campaign->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $campaign->updated_at }}</p>
</div>

