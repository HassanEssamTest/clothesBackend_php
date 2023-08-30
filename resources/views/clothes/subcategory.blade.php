@if ($type=='Category[]')
<br>
    <div class="form-group row ">
        {!! Form::label('subcategory[]', 'Clothes SubCategory',['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('subcategory', $subcategory, $Selectedsubcategory, ['class' => 'select2 form-control' ]) !!}
            <div class="form-text text-muted">{{ 'Clothes SubCategory' }}</div>
        </div>
    </div> 
@endif
@if ($type=='sizes[]')
<br>
<div class="form-group row ">
    {!! Form::label('subsize', 'sub size',['class' => 'col-3 control-label text-right']) !!}
    <div class="col-9">
        {{-- {{dd($subsize)}} --}}
        {!! Form::select('subsize', $subsize, $Selectedsubsize, ['class' => 'select2 form-control']) !!}
        <div class="form-text text-muted">{{ 'sub size' }}</div>
    </div>
</div>
@endif
@if ($type=='eCategory[]')
<br>
    <div class="form-group row ">
        {!! Form::label('subcategory[]', 'Clothes SubCategory',['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('subcategory', $subcategory, $Selectedsubcategory, ['class' => 'select2 form-control' ]) !!}
            <div class="form-text text-muted">{{ 'Clothes Sub Category' }}</div>
        </div>
    </div> 
@endif