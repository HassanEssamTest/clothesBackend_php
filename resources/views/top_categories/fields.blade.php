
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

<!-- category Id Field -->
<div class="form-group row ">
  {!! Form::label('category_id', trans("lang.category"),['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
      {!! Form::select('category_id', $category, null, ['class' => 'select2 form-control']) !!}
      <div class="form-text text-muted">{{ trans("lang.category_name_help") }}</div>
  </div>
</div>

<!-- clothes category Id Field -->
<div class="form-group row ">
  {!! Form::label('clothes_category_id', trans("lang.clothes_category"),['class' => 'col-3 control-label text-right']) !!}
  <div class="col-9">
      {!! Form::select('clothes_category_id', $clothesCategory, null, ['class' => 'select2 form-control']) !!}
      <div class="form-text text-muted">{{ trans("lang.clothes_category_name") }}</div>
  </div>
</div>

<!-- Submit Field -->
<div class="form-group col-12 text-right">
  <button type="submit" class="btn btn-{{setting('theme_color')}}" ><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.topCategory')}}</button>
  <a href="{!! route('offers.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
