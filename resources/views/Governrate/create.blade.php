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
        <h1 class="m-0 text-dark">Governorate<small class="ml-3 mr-3">|</small><small>Governorate</small></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> {{trans('lang.dashboard')}}</a></li>
          <li class="breadcrumb-item"><a href="{!! route('governorate.index') !!}">Governorate</a>
          </li>
          <li class="breadcrumb-item active">Create Governorate</li>
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
        @can('governorate.index')
        <li class="nav-item">
          <a class="nav-link" href="{!! route('governorate.index') !!}"><i class="fa fa-list mr-2"></i>Governorates Table</a>
        </li>
        @endcan
        <li class="nav-item">
          <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-plus mr-2"></i>Create Governorate</a>
        </li>
      </ul>
    </div>
    <div class="card-body">
      {{-- {!! Form::open(['route' => 'governorate.store']) !!} --}}
      <form action="{{route("governorate.store")}}" method="POST">
      @csrf
        <div class="row">
          <div class="col-sm-6 col-12">
          <div class="form-group"> 
            <div class="col-sm-6 col-12">
              <div class="form-group">
                <label>Governorate Name &nbsp; </label>
              <input type="text" class="form-control" name="name" required >
          </div>
        </div>
      </div>
      <button class="btn btn-primary btn-cons"  style=" float:right;" >  Add Governorate</button>
    </form>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
@include('layouts.media_modal')
@endsection
@push('scripts_lib')

<script src="{{asset('plugins/select2/select2.min.js')}}"></script>
@endpush