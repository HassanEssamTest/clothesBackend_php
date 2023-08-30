<!-- Id pricing -->
<div class="form-group row col-6">
  {!! Form::label('id', 'Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $pricing->id !!}</p>
  </div>
</div>

<!-- Shop Id Field -->
<div class="form-group row col-6">
  {!! Form::label('governorate_id', 'Shop Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $pricing->governorate_id !!}</p>
  </div>
</div>

<!-- Shop Id Field -->
<div class="form-group row col-6">
  {!! Form::label('city_id', 'Shop Id:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $pricing->city_id !!}</p>
  </div>
</div>

<!-- price pricing -->
<div class="form-group row col-6">
  {!! Form::label('price', 'price:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $pricing->price !!}</p>
  </div>
</div>

<!-- Created At pricing -->
<div class="form-group row col-6">
  {!! Form::label('created_at', 'Created At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $pricing->created_at !!}</p>
  </div>
</div>

<!-- Updated At pricing -->
<div class="form-group row col-6">
  {!! Form::label('updated_at', 'Updated At:', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
    <p>{!! $pricing->updated_at !!}</p>
  </div>
</div>

