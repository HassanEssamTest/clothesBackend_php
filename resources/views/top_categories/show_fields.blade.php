<!-- Id offer -->
<div class="form-group row col-6">
  {!! Form::label('id', 'Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $topCategory->id !!}</p>
  </div>
</div>

<!-- Name offer -->
<div class="form-group row col-6">
  {!! Form::label('name', 'Name:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $topCategory->category->name !!}</p>
  </div>
</div>

<!-- Name offer -->
<div class="form-group row col-6">
  {!! Form::label('name', 'Name:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $topCategory->clothes_category->name !!}</p>
  </div>
</div>

<!-- Updated At offer -->
<div class="form-group row col-6">
  {!! Form::label('updated_at', 'Updated At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $topCategory->updated_at !!}</p>
  </div>
</div>

