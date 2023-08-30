<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">


<!-- Shop Id Field -->
<div class="form-group row ">
  {!! Form::label('from_governorate_id', 'From Governorate',['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
      {!! Form::select('from_governorate_id', $governorates, null, ['class' => 'select2 form-control', 'id'=>'governorate']) !!}
      <div class="form-text text-muted">From Governorate</div>
  </div>
</div>

<div class="from_city">

</div>


<!-- Shop Id Field -->
<div class="form-group row ">
  {!! Form::label('to_governorate_id', 'To Governorate',['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
      {!! Form::select('to_governorate_id', $governorates, null, ['class' => 'select2 form-control', 'id'=>'governorate']) !!}
      <div class="form-text text-muted">To Governorate</div>
  </div>
</div>

<div class="to_city">

</div>


<!-- Longitude Field -->
<div class="form-group row ">
  {!! Form::label('price', 'price', ['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
      {!! Form::number('price', null,  ['class' => 'form-control','placeholder'=>  'Price']) !!}
      <div class="form-text text-muted">
          Price
      </div>
  </div>
</div>

<!-- Submit Field -->
<div class="form-group col-12 text-right">
  <button type="submit" class="btn btn-{{setting('theme_color')}}" ><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.pricing')}}</button>
  <a href="{!! route('pricings.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
