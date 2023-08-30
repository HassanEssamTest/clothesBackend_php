<!-- Id media -->
<div class="form-group row col-6">
  {!! Form::label('id', 'Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $mediaLibrary->id !!}</p>
  </div>
</div>

<!-- Name media -->
<div class="form-group row col-6">
  {!! Form::label('name', 'Name:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $mediaLibrary->name !!}</p>
  </div>
</div>

<!-- Description media -->
<div class="form-group row col-6">
  {!! Form::label('description', 'Description:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $mediaLibrary->description !!}</p>
  </div>
</div>

<!-- Shop Id Field -->
<div class="form-group row col-6">
  {!! Form::label('price', 'Price:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $mediaLibrary->price !!}</p>
  </div>
</div>

<div class="form-group row col-6">
  {!! Form::label('gender', 'Gender:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $mediaLibrary->gender !!}</p>
  </div>
</div>

<!-- Created At media -->
<div class="form-group row col-6">
  {!! Form::label('created_at', 'Created At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $mediaLibrary->created_at !!}</p>
  </div>
</div>

<!-- Updated At media -->
<div class="form-group row col-6">
  {!! Form::label('updated_at', 'Updated At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $mediaLibrary->updated_at !!}</p>
  </div>
</div>

