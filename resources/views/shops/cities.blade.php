@if ($type=='governorates')
{{-- <div class="form-group"> --}}
    <br>
       <div class="form-group row ">
           {!! Form::label('city', 'City',['class' => 'col-3 control-label text-right ']) !!}
            <div class="col-9">
               {!! Form::select('city',$cities , $citySelected, ['class' => 'select2 form-control']) !!}
               <div class="form-text text-muted">City</div>
           </div>
    </div>
    {{-- <div class="form-group row ">
        {!! Form::label('governorates', 'Governorate',['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('governorates', $governorates, $governorateSelected, ['class' => 'select2 form-control changeLocation' , 'id'=>'gover']) !!}
            <div class="form-text text-muted">Governorate</div>
        </div>
    </div> --}}
{{-- </div> --}}
@endif

