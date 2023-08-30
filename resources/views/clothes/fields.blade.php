@if($customFields)
    <h5 class="col-12 pb-4">{!! trans('lang.main_fields') !!}</h5>
@endif
<div style="padding: 0 4px;" class="column col-lg-6 col-sm-12">
    <!-- Name Field -->
    <div class="form-group row ">
        {!! Form::label('name', trans("lang.clothes_name"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('name', null,  ['class' => 'form-control','placeholder'=>  trans("lang.clothes_name_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.clothes_name_help") }}
            </div>
        </div>
    </div>

    <!-- Image Field -->
    <div class="form-group row">
        {!! Form::label('image', trans("lang.clothes_image"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            <div style="width: 100%" class="dropzone image" id="image" data-field="image">
                {{-- <label>Add Image</label> --}}
                 <div class="images-inputs-container"> 
                    <input type="text" id="dropzone_input" hidden>
                </div> 
            {{-- <div class="dropzone my-dropzone" data-inputname="{{$inputName ?? 'images[]'}}" > --}}
                    <div class="fallback">
                        <input name="file" id="dropzone_input"   type="file" multiple />
                    </div>
                {{-- </div> --}}
            </div>
            <a href="#loadMediaModal" data-dropzone="image" data-toggle="modal" data-target="#mediaModal" class="btn btn-outline-{{setting('theme_color','primary')}} btn-sm float-right mt-1">{{ trans('lang.media_select')}}</a>
            <div class="form-text text-muted w-50">
                {{ trans("lang.clothes_image_help") }}
            </div>
        </div>
    </div>
     @prepend('scripts')

        <script type="text/javascript">
            var var15671147171873255749ble = '';
            @if(isset($clothes) && $clothes->hasMedia('image'))
               
                var15671147171873255749ble = {
                name: "{!! $clothes->getFirstMedia('image')->name !!}",
                size: "{!! $clothes->getFirstMedia('image')->size !!}",
                type: "{!! $clothes->getFirstMedia('image')->mime_type !!}",
                collection_name: "{!! $clothes->getFirstMedia('image')->collection_name !!}"
            };
                    @endif
            var dz_var15671147171873255749ble = $(".dropzone.image").dropzone({
                    url: "{!!url('uploads/store')!!}",
                    addRemoveLinks: true,
                    maxFiles: 66,
                    init: function () {
                        @if(isset($clothes) && $clothes->hasMedia('image'))
                        dzInit(this, var15671147171873255749ble, '{!! url($clothes->getFirstMediaUrl('image','thumb')) !!}')
                        @endif
                    },
                    accept: function (file, done) {
                        // console.log(done);
                        dzAccept(file, done, this.element, "{!!config('medialibrary.icons_folder')!!}");
                    },
                    success:function(file, response) {
                        console.log(response);
                    var val = document.getElementById('dropzone_input').value;
                     $("#dropzone_input").clone().val(response).attr('id', file.upload.uuid).attr('name','image[]').appendTo(".images-inputs-container");
                     },
                    sending: function (file, xhr, formData) {
                        dzSending(this, file, formData, '{!! csrf_token() !!}');
                    },
                    maxfilesexceeded: function (file) {
                        dz_var15671147171873255749ble[0].mockFile = '';
                        dzMaxfile(this, file);
                    },
                    complete: function (file) {
                        dzComplete(this, file, var15671147171873255749ble, dz_var15671147171873255749ble[0].mockFile);
                        dz_var15671147171873255749ble[0].mockFile = file;
                    },
                    removedfile: function (file) {
                        dzRemoveFile(
                            file, var15671147171873255749ble, '{!! url("clothess/remove-media") !!}',
                            'image', '{!! isset($clothes) ? $clothes->id : 0 !!}', '{!! url("uplaods/clear") !!}', '{!! csrf_token() !!}'
                        );
                    }
                });
            dz_var15671147171873255749ble[0].mockFile = var15671147171873255749ble;
            dropzoneFields['image'] = dz_var15671147171873255749ble;
        </script>
    @endprepend

<!-- Price Field -->
    <div class="form-group row ">
        {!! Form::label('price', trans("lang.clothes_price"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::number('price', null,  ['class' => 'form-control','placeholder'=>  trans("lang.clothes_price_placeholder"),'step'=>"any", 'min'=>"0"]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.clothes_price_help") }}
            </div>
        </div>
    </div>

    <!-- Discount Price Field -->
    <div class="form-group row ">
        {!! Form::label('discount_price', trans("lang.clothes_discount_price"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::number('discount_price', null,  ['class' => 'form-control','placeholder'=>  trans("lang.clothes_discount_price_placeholder"),'step'=>"any", 'min'=>"0"]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.clothes_discount_price_help") }}
            </div>
        </div>
    </div>

    <!-- Description Field -->
    <div class="form-group row ">
        {!! Form::label('description', trans("lang.clothes_description"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::textarea('description', null, ['class' => 'form-control','placeholder'=>
             trans("lang.clothes_description_placeholder")  ]) !!}
            <div class="form-text text-muted">{{ trans("lang.clothes_description_help") }}</div>
        </div>
    </div>

    <!-- Amount Field -->
    <div class="form-group row ">
        {!! Form::label('amount', trans("lang.clothes_amount"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::number('amount', null,  ['class' => 'form-control','placeholder'=>  1,'step'=>"any", 'min'=>"0"]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.clothes_amount") }}
            </div>
        </div>
    </div>
    <br>

    <!-- Sizes, Colours, and quantity -->
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
              <form action="" >
  
              <div class="input-group control-group after-add-more" id="edirr" style="padding: 50px">
                  <div class="input-group-btn"> 
                    <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add Colour </button>
                  </div>
              </div>
      
              </form>

              @foreach ($quantitySelected as $index => $quantity)
                {{-- <div class='copy-fields'>
                    <div>1111111111111111</div>
                    <div>{{$quantity->colour->name}}</div>
                    <div class="control-group input-group-$index" style='margin-top:10px; padding: 0px 0px 0px 100px; margin: 0px 0px 20px 100px; display: flex;'>
                        <select class='form-select mr-3' name="colours-$index[]" id="mainColours$index"> <option selected value={{$quantity->colour_id}}>{{$quantity->colour->name}}</option> @foreach ($colour as $key => $value) <option value='{{ $key }}'>{{ $value }}</option>@endforeach</select>
                        <select class='form-select' name="sizes-$index[]" id="mainSizes$index"> <option selected value={{$quantity->size_id}}>{{$quantity->size->name}}</option> @foreach ($size as $key => $value) <option value='{{ $key }}'>{{ $value }}</option>@endforeach</select>
                        <input value={{$quantity->quantity}} type='number', name="quantities-$index[]", class='col-3 control-label', id="mainQuantites$index", placeholder='Quantity', step='any', min='0' style= 'width:50%' >
                        <div class='input-group-btn'> <button class="btn btn-danger remove remove-childs-$index" type='button'><i class='glyphicon glyphicon-remove'></i> Remove</button></div>
                        <div class='input-group-btn'><button class="btn btn-success add-more-more-$index" id='add-more-more' type='button'><i class='glyphicon glyphicon-plus'></i> Add </button></div>
                    </div>
                </div> --}}

                {{-- <div class='copy-fields'>
                    <div class="control-group input-group child-$index" style='margin-top:10px; padding: 0px 0px 0px 100px; margin: 10px 0px 40px 100px; display: flex;'>
                        <select class='form-select' style='margin-left: 96px;' name="sizes-$index[]" id="mainSizes$index"> @foreach ($size as $key => $value) <option value='{{ $key }}'>{{ $value }}</option>@endforeach</select>
                        <input type='number', name="quantities-$index[]", class='col-3 control-label', id="mainQuantites$index", placeholder='Quantity', step='any', min='0' style='width: 29%;'>
                        <div class='input-group-btn'> <button class='btn btn-secondary remove' type='button'><i class='glyphicon glyphicon-remove'></i> X </button></div>
                    </div>
                </div> --}}
                <div>
                    <div class="control-group input-group" style="margin-top:10px; padding: 0px 0px 0px 100px; margin: 0px 0px 0px 100px">
                        {!! Form::select('colours[]', $colour, $quantity->colour_id, ['class' => 'form-select mr-3', 'aria-label' => 'Select Color','required']) !!}
                        
                        {!! Form::select('sizes[]', $size, $quantity->size_id, ['class' => 'form-select', 'aria-label' => 'Select Size', 'required']) !!}

                        {!! Form::number('quantities[]', $quantity->quantity, ['class' => 'col-3 control-label', 'placeholder'=> "Quantity", 'step'=>"any", 'min'=>"0"]) !!}
                        <div class="input-group-btn"> 
                            <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                        </div>
                    </div>
                </div>
              @endforeach

                <div class="testg">
                    <div class="testg1" style="margin-top:10px; padding: 0px 0px 0px 100px; margin: 0px 0px 0px 100px">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    

</div>
<div style="padding: 0 4px;" class="column col-lg-6 col-sm-12">

    <!-- Ingredients Field -->
    <div class="form-group row ">
        {!! Form::label('ingredients', trans("lang.clothes_ingredients"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::textarea('ingredients', null, ['class' => 'form-control','placeholder'=>
             trans("lang.clothes_ingredients_placeholder")  ]) !!}
            <div class="form-text text-muted">{{ trans("lang.clothes_ingredients_help") }}</div>
        </div>
    </div>

    <!-- unit Field -->
    <div class="form-group row ">
        {!! Form::label('unit', trans("lang.clothes_unit"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('unit', null,  ['class' => 'form-control','placeholder'=>  trans("lang.clothes_unit_placeholder")]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.clothes_unit_help") }}
            </div>
        </div>
    </div>

    <!-- package_items_count Field -->
    <div class="form-group row ">
        {!! Form::label('package_items_count', trans("lang.clothes_package_items_count"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::number('package_items_count', null,  ['class' => 'form-control','placeholder'=>  trans("lang.clothes_package_items_count_placeholder"),'step'=>"any", 'min'=>"0"]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.clothes_package_items_count_help") }}
            </div>
        </div>
    </div>

    <!-- Weight Field -->
    <div class="form-group row ">
        {!! Form::label('weight', trans("lang.clothes_weight"), ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::number('weight', null,  ['class' => 'form-control','placeholder'=>  trans("lang.clothes_weight_placeholder"),'step'=>"0.01", 'min'=>"0"]) !!}
            <div class="form-text text-muted">
                {{ trans("lang.clothes_weight_help") }}
            </div>
        </div>
    </div>

    <!-- 'Boolean Featured Field' -->
    <div class="form-group row ">
        {!! Form::label('featured', trans("lang.clothes_featured"),['class' => 'col-3 control-label text-right']) !!}
        <div class="checkbox icheck">
            <label class="col-9 ml-2 form-check-inline">
                {!! Form::hidden('featured', 0) !!}
                {!! Form::checkbox('featured', 1, null) !!}
            </label>
        </div>
    </div>

    <!-- 'Boolean deliverable Field' -->
    <div class="form-group row ">
        {!! Form::label('deliverable', trans("lang.clothes_deliverable"),['class' => 'col-3 control-label text-right']) !!}
        <div class="checkbox icheck">
            <label class="col-9 ml-2 form-check-inline">
                {!! Form::hidden('deliverable', 0) !!}
                {!! Form::checkbox('deliverable', 1, null) !!}
            </label>
        </div>
    </div>

    <!-- Shop Id Field -->
    <div class="form-group row ">
        {!! Form::label('shop_id', trans("lang.clothes_shop_id"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('shop_id', $shop, null, ['class' => 'select2 form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.clothes_shop_id_help") }}</div>
        </div>
    </div>
    {{-- category --}}
    <div class="form-group row ">
        {!! Form::label('Categories[]','Category',['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('Category[]', $category, $categorySelected, ['class' => 'select2 form-control' ,'id'=>'category' , 'multiple'=>'multiple', 'required']) !!}
            <div class="form-text text-muted">{{'Category' }}</div>
        </div>
    </div>

    @if(!empty($selected_clothes_subcategory))
        <div class="form-group row" id="testid">
            {!! Form::label('subcategory[]', 'Clothes SubCategory',['class' => 'col-3 control-label text-right']) !!}
            <div class="col-9">
                {!! Form::select('subcategory', $subcategory, $selected_clothes_subcategory, ['class' => 'select2 form-control' ]) !!}
                <div class="form-text text-muted">{{ 'Clothes SubCategory' }}</div>
            </div>
        </div> 

        <div class="editsubcatigory">

        </div>

    @else
        <div class="subcatigory">

        </div>
    @endif

    <!-- clothes Category Field -->
    <div class="form-group row ">
        {!! Form::label('clothesCategory[]',' clothes Gender Category',['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('clothesCategory[]', $clothesCategory, $clothesCategorySelected, ['class' => 'select2 form-control' , 'multiple'=>'multiple', 'required']) !!}
            <div class="form-text text-muted">{{'clothes Gender Category' }}</div>
        </div>
    </div>

    @if(isset($type))
        <!-- clothes Category Field -->
        <div class="form-group row ">
            {!! Form::label('clothesType', trans("lang.clothes_type"),['class' => 'col-3 control-label text-right']) !!}
            <div class="col-9">
                {!! Form::label('clothesType', trans("lang.clothes_type_coins"),['class' => 'col-5 control-label text-right']) !!}
                    {!! Form::radio('type', 'coins', true) !!}

                {!! Form::label('clothesType', trans("lang.clothes_type_commission"),['class' => 'col-5 control-label text-right']) !!}
                {!! Form::radio('type', 'commission', false) !!}
            </div>
        </div>
    @endif
</div>
@if($customFields)
    <div class="clearfix"></div>
    <div class="col-12 custom-field-container">
        <h5 class="col-12 pb-4">{!! trans('lang.custom_field_plural') !!}</h5>
        {!! $customFields !!}
    </div>
@endif
<!-- Submit Field -->
<div class="form-group col-12 text-right">
    <button type="submit" class="btn btn-{{setting('theme_color')}}"><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.clothes')}}</button>
    <a href="{!! route('clothes.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>


<script type="text/javascript">
    var MyData = {};
    MyData.count = 0;
    $(document).ready(function() {
        $(".add-more").click(function(){ 
            MyData.count += 1;
            count = MyData.count;
            var fist = "<div class='copy-fields'> <div class='control-group input-group-" + count + "' style='margin-top:10px; padding: 0px 0px 0px 100px; margin: 0px 0px 20px 10px; display: flex;'>";
            var one = fist + "<select class='form-select mr-3' name='colours-"+count+"[]' id='mainColours"+count+"'> @foreach ($colour as $key => $value) <option value='{{ $key }}'>{{ $value }}</option>@endforeach</select>"
            var two = one + "<select class='form-select' name='sizes-"+count+"[]' id='mainSizes"+count+"'> @foreach ($size as $key => $value) <option value='{{ $key }}'>{{ $value }}</option>@endforeach</select>"
            var three = two + "<input type='number', name='quantities-"+count+"[]', 'class'='col-3 control-label', 'id'='mainQuantites" + count + "', placeholder='1', step=1, min=1 style= 'width:150px' >";
            var four = three + "<div class='input-group-btn'> <button class='btn btn-danger remove remove-childs-" + count + "' type='button'><i class='glyphicon glyphicon-remove'></i> Remove</button></div>";
            var five = four + "<div class='input-group-btn'><button class='btn btn-success add-more-more-" + count + "' id='add-more-more' type='button'><i class='glyphicon glyphicon-plus'></i> Add Size </button></div></div></div>"
            $(".after-add-more").after(five);
        });
        $("body").on("click", "#add-more-more", function(event){
            var parentClass = $(event.target).attr('class');
            var words = parentClass.split('-');
            var childCount = words[4];
            var fist = "<div class='copy-fields'> <div class='control-group input-group child-"+childCount+"' style='margin-top:10px; padding: 0px 0px 0px 100px; margin: 10px 0px 40px 10px; display: flex;'>";
            var two = fist + "<select class='form-select' style='margin-left: 96px;' name='sizes-"+childCount+"[]' id='mainSizes"+childCount+"'> @foreach ($size as $key => $value) <option value='{{ $key }}'>{{ $value }}</option>@endforeach</select>"
            var three = two + "<input type='number', name='quantities-"+childCount+"[]', 'class'='col-3 control-label', 'id'='mainQuantites" + childCount + "', placeholder='1', step=1, min=1 style='width: 150px;'>";
            var four = three + "<div class='input-group-btn'> <button class='btn btn-secondary remove' type='button'><i class='glyphicon glyphicon-remove'></i> X </button></div></div></div>";
            $($(".input-group-" + childCount)).after(four);
            childCount += 1;
        });
        //here it will remove the current value of the remove button which has been pressed
        $("body").on("click",".remove", function(event){ 
            $(this).parents(".control-group").remove();

            var parentClass = $(event.target).attr('class');
            var words = parentClass.split('-');
            var childCount = words[words.length-1];
            $(".child-" + childCount).remove();
        });

    });

</script>
