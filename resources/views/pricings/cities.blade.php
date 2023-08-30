@if ($type=='from_governorate_id')
<br>
    <div class="form-group row ">
        {!! Form::label('from_city', 'From City',['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('from_city', $from_city, $selectedFromCities, ['class' => 'select2 form-control' ]) !!}
            <div class="form-text text-muted">{{ 'From City' }}</div>
        </div>
    </div> 
@endif

@if ($type=='to_governorate_id')
<br>
    <div class="form-group row ">
        {!! Form::label('to_city', 'To City',['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('to_city', $to_city, $selectedToCities, ['class' => 'select2 form-control' ]) !!}
            <div class="form-text text-muted">{{ 'To City' }}</div>
        </div>
    </div> 
@endif
