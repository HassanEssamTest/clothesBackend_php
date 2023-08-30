@extends('layouts.app')
@push('css_lib')
<!-- iCheck -->
<link rel="stylesheet" href="{{asset('plugins/iCheck/flat/blue.css')}}">
<!-- select2 -->
<link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
{{--dropzone--}}
<link rel="stylesheet" href="{{asset('plugins/dropzone/bootstrap.min.css')}}">
@endpush
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{trans('lang.media_plural')}}<small class="ml-3 mr-3">|</small><small>{{trans('lang.media_desc')}}</small></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> {{trans('lang.dashboard')}}</a></li>
          <li class="breadcrumb-item"><a href="{!! route('mediaLibrary.index') !!}">{{trans('lang.media_plural')}}</a>
          </li>
          <li class="breadcrumb-item active">{{trans('lang.media_create')}}</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="content">
  <div class="clearfix"></div>
  @include('flash::message')
  @include('adminlte-templates::common.errors')
  <div class="clearfix"></div>
  <div class="card">
    <div class="card-header">
      <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
        @can('factory.index')
        <li class="nav-item">
          <a class="nav-link" href="{!! route('factory.index') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.media_table')}}</a>
        </li>
        @endcan
        <li class="nav-item">
          <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.media_create')}}</a>
        </li>
      </ul>
    </div>
    <div class="card-body">
        <form action="{{ route('factory.store') }}" method="POST">
        @csrf
           
            <div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
                <!-- Name Field -->
                <div class="form-group row ">
                    {!! Form::label('name', trans("lang.media_title"), ['class' => 'col-3 control-label text-right']) !!}
                    <div class="col-9">
                        {!! Form::text('name', null,  ['class' => 'form-control','placeholder'=>  trans("lang.media_title"), 'required']) !!}
                        <div class="form-text text-muted">
                            {{ trans("lang.media_title") }}
                        </div>
                    </div>
                </div>
              
                  <div class="form-group row">
                      {!! Form::label('image', trans("lang.media_title"), ['class' => 'col-3 control-label text-right']) !!}
                      <div class="col-9">
                          <div style="width: 100%" class="dropzone image" id="image" data-field="image">
                              {{-- <input type="hidden" name="image"> --}}
                              <div class="images-inputs-container"> 
                                  <input type="text" id="dropzone_input" hidden>
                              </div> 
                          </div>
                          <a href="#loadMediaModal" data-dropzone="image" data-toggle="modal" data-target="#mediaModal" class="btn btn-outline-{{setting('theme_color','primary')}} btn-sm float-right mt-1">{{ trans('lang.media_select')}}</a>
                          <div class="form-text text-muted w-50">
                              {{ trans("lang.media_image_help") }}
                          </div>
                      </div>
                  </div>
                  @prepend('scripts')
                      <script type="text/javascript">
                          var var15671147011688676454ble = '';
                          @if(isset($media) && $media->hasMedia('image'))
                              var15671147011688676454ble = {
                              name: "{!! $media->getFirstMedia('image')->name !!}",
                              size: "{!! $media->getFirstMedia('image')->size !!}",
                              type: "{!! $media->getFirstMedia('image')->mime_type !!}",
                              collection_name: "{!! $media->getFirstMedia('image')->collection_name !!}"
                          };
                                  @endif
                          var dz_var15671147011688676454ble = $(".dropzone.image").dropzone({
                                  url: "{!!route('image.store')!!}",
                                  addRemoveLinks: true,
                                  maxFiles: 20,
                                  init: function () {
                                      @if(isset($media) && $media->hasMedia('image'))
                                      dzInit(this, var15671147011688676454ble, '{!! url($media->getFirstMediaUrl('image','thumb')) !!}')
                                      @endif
                                  },
                                  accept: function (file, done) {
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
                                      dz_var15671147011688676454ble[0].mockFile = '';
                                      dzMaxfile(this, file);
                                  },
                                  complete: function (file) {
                                      dzComplete(this, file, var15671147011688676454ble, dz_var15671147011688676454ble[0].mockFile);
                                      dz_var15671147011688676454ble[0].mockFile = file;
                                  },
                                  removedfile: function (file) {
                                      dzRemoveFile(
                                          file, var15671147011688676454ble, '{!! url("medias/remove-media") !!}',
                                          'image', '{!! isset($media) ? $media->id : 0 !!}', '{!! url("uplaods/clear") !!}', '{!! csrf_token() !!}'
                                      );
                                  }
                              });
                          dz_var15671147011688676454ble[0].mockFile = var15671147011688676454ble;
                          dropzoneFields['image'] = dz_var15671147011688676454ble;
                      </script>
                  @endprepend
              
                  <!-- Price Field -->
                  <div class="form-group row ">
                      {!! Form::label('price', trans("lang.clothes_price"), ['class' => 'col-3 control-label text-right']) !!}
                      <div class="col-9">
                          {!! Form::number('price', null,  ['class' => 'form-control','placeholder'=>  trans("lang.clothes_price_placeholder"),'step'=>"any", 'min'=>"0", 'required']) !!}
                          <div class="form-text text-muted">
                              {{ trans("lang.clothes_price_help") }}
                          </div>
                      </div>
                  </div>
              
                  <div class="form-group row ">
                      {!! Form::label('gender', trans("lang.media_gender"),['class' => 'col-3 control-label text-right']) !!}
                      <div class="col-9">
                          {!! Form::label('gender', trans("lang.media_gender_male"),['class' => 'col-3 control-label text-right']) !!}
                              {!! Form::radio('gender', 'male', true) !!}
              
                          {!! Form::label('gender', trans("lang.media_gender_female"),['class' => 'col-3 control-label text-right']) !!}
                          {!! Form::radio('gender', 'female', false) !!}
                      </div>
                  </div>
              
                <!-- Description Field -->
                <div class="form-group row ">
                    {!! Form::label('description', trans("lang.clothes_description"), ['class' => 'col-3 control-label text-right']) !!}
                    <div class="col-9">
                        {!! Form::textarea('description', null, ['class' => 'form-control','placeholder'=>
                         trans("lang.clothes_description_placeholder"), 'required'  ]) !!}
                        <div class="form-text text-muted">{{ trans("lang.clothes_description_help") }}</div>
                    </div>
                </div>
                
                  {{-- category --}}
                  <div class="form-group row ">
                    {!! Form::label('Categories[]','Category',['class' => 'col-3 control-label text-right']) !!}
                    <div class="col-9">
                        {!! Form::select('Category[]', $category, $categorySelected, ['class' => 'select2 form-control' , 'multiple'=>'multiple', 'required']) !!}
                        <div class="form-text text-muted">{{'Category' }}</div>
                    </div>
                </div>
                <div class="form-group row ">
                    {!! Form::label('subcategory[]', ' SubCategory',['class' => 'col-3 control-label text-right']) !!}
                    <div class="col-9">
                        {!! Form::select('subcategory[]', $subcategory, $Selectedsubcategory, ['class' => 'select2 form-control' , 'multiple'=>'multiple' ]) !!}
                        <div class="form-text text-muted">{{ 'Media SubCategory' }}</div>
                    </div>
                </div> 

                <!-- Colours Field -->
                <div class="form-group row ">
                    {!! Form::label('colour[]', trans("lang.clothes_colour_category"),['class' => 'col-3 control-label text-right']) !!}
                    <div class="col-9">
                        {!! Form::select('colours[]', $colour, $coloursSelected, ['class' => 'select2 form-control' , 'multiple'=>'multiple', 'required']) !!}
                        <div class="form-text text-muted">{{ trans("lang.clothes_colour_category") }}</div>
                    </div>
                </div>
            </div>



                <div class="form-group col-12 text-right">
                    <button type="submit" class="btn btn-{{setting('theme_color')}}"><i class="fa fa-save"></i> {{trans('lang.save')}} Factory Product</button>
                    <a href="{{ route('factory.index') }}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
                  </div>
                  
        </form>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
@include('layouts.media_modal')
@endsection
@push('scripts_lib')
<!-- iCheck -->
<script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
<!-- select2 -->
<script src="{{asset('plugins/select2/select2.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
{{--dropzone--}}
<script src="{{asset('plugins/dropzone/dropzone.js')}}"></script>
<script type="text/javascript">
    Dropzone.autoDiscover = false;
    var dropzoneFields = [];
</script>
@endpush