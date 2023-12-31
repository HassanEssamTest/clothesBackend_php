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
        <h1 class="m-0 text-dark">{{trans('lang.clothes_category_plural')}}<small class="ml-3 mr-3">|</small><small>SubCategories</small></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> {{trans('lang.dashboard')}}</a></li>
          <li class="breadcrumb-item"><a href="{!! route('brand.index') !!}">SubCategories</a>
          </li>
          <li class="breadcrumb-item active">Create brand</li>
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
        @can('brand.index')
        <li class="nav-item">
          <a class="nav-link" href="{!! route('brand.index') !!}"><i class="fa fa-list mr-2"></i>subcategories Table</a>
        </li>
        @endcan
        <li class="nav-item">
          <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-plus mr-2"></i>Create brand</a>
        </li>
      </ul>
    </div>
    <div class="card-body">
      {{-- {!! Form::open(['route' => 'brand.store']) !!} --}}
      <form action="{{route("brand.store")}}" method="POST">
      @csrf
      <input type="text" value="category_id" name="subfor" hidden>
        <div class="row">
            <div class="col-sm-6 col-12">
              <div class="form-group">
                <label>Brand Name &nbsp; </label>
                <input type="text" class="form-control" name="name" required >
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


      </div>
      <button class="btn btn-primary btn-cons"  style=" float:right;" >  Add brand</button>
    </form>
      {{-- {!! Form::close() !!} --}}
      <div class="clearfix"></div>
    </div>
  </div>
</div>
@include('layouts.media_modal')
@endsection
@push('scripts_lib')
{{-- <!-- iCheck -->
{{-- <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script> --}}
<!-- select2 --> --}}
<script src="{{asset('plugins/select2/select2.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
{{--dropzone--}}
<script src="{{asset('plugins/dropzone/dropzone.js')}}"></script>
@endpush