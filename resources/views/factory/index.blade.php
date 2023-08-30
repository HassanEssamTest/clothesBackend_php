@extends('layouts.app')
@push('css_lib')
    <!-- select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
    {{--dropzone--}}
    {{-- <link rel="stylesheet" href="{{asset('plugins/dropzone/bootstrap.min.css')}}"> --}}
@endpush
@section('content')
<head>
    <style>
        #clickble {
                width: 20%;
            }
        @media (max-width: 577px) {
            .wrapper .content-wrapper #page .content .card .card-body .row .media-item #clickble {
                width: 36%;
            }
        }
    </style>
</head>
<div id="page">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Factories Products </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> {{trans('lang.dashboard')}}</a></li>
                        <li class="breadcrumb-item active">Factory</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="clearfix"></div>
        @include('flash::message')
        <div id="mediaModal" class="card">
            <div class="card-header">
                <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                    <li class="nav-item">
                        <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.media_table')}}</a>
                    </li>
                    @hasanyrole('admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{!! url('factory/create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.media_create')}}</a>
                        </li>                        
                    @endhasanyrole
                    @hasanyrole('admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{!! url('factory/all') !!}"><i class="fa fa-list mr-2"></i></i>Factory table</a>
                    </li>                        
                @endhasanyrole
 
                
                        @if ( Request::is('factory/filter'))
                       
                        <li class="form-control-sm " style="  margin-right:5px; ">
                            <a class="btn btn-danger form-control-sm form-control"  href="{!! url('factory') !!}"><i class="fa fa-remove mr-2"></i> Remove Filter </a>
                        </li>   
                        @endif
                    </ul>
            </div>
                <form action="{{ route('factory.filter') }}" method="POST" id="filterForm">
                    <ul class="nav nav-tabs align-items-end card-header-tabs" style=" margin: revert;" >
                        <div class="ml-3 d-inline-flex row">
                            <li class="nav-item col-lg-3 col-md-6 col-sm-12">
                                @csrf
                                <div id="selectCollection" class="ml-auto pb-2 mx-2">
                                    <select name="category" id="filter" class="form-control-sm form-control select2 filter">
                                        <option selected hidden value="" >Category Filter</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </li>
                            <li class="nav-item col-lg-3 col-md-6 col-sm-12">
                        
                                <div id="selectCollection" class="ml-auto pb-2 mx-2">
                                    <select name="color" id="filter" class="form-control-sm   select2 filter">
                                        <option selected hidden value="" >Color Filter</option>
                                        @foreach ($colourCategories as $colorcategory)
                                        <option value="{{ $colorcategory->name }}">{{ $colorcategory->name }}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </li>
                            <li style="margin-right:5px;" class="col-lg-1 col-md-5 col-sm-6 mt-1">
                                <input type="number" class="form-control-sm form-control " name="from"  value="0" placeholder="Price From">
                            </li>
                            <li style="margin-right:5px;" class="col-lg-2 col-md-5 col-sm-6 mt-1 mb-1">
                                <input type="number" class="form-control-sm form-control " name="to"  value="10000000" placeholder="Price to">
                            </li>
                            <li class="col-lg-2 col-md-6 col-sm-12">
                                <button type="submit" class="btn btn-success form-control-sm form-control" > Apply Filter</button>
                            </li>
                        </div>
                    </ul>
                </form>
           
            <div class="card-body">
                <!-- Preview Field -->
                <div id="createMediaField" class="row">
                    <div class="col-12">
                        {{-- <div style="width: 100%" class="dropzone default" id="default" data-field="default">
                            <input type="hidden" name="default">
                        </div> --}}
                        {{-- <a href="#" id="doneMedia" class="btn btn-outline-{{setting('theme_color','primary')}} btn-sm float-right mt-1">{{ trans('lang.done')}}</a> --}}
                        <div class="form-text text-muted">
                            {{ trans("lang.media_default_help") }}
                        </div>
                    </div>
                    <div class="clearfix my-5"></div>
                </div>
                <div class="row medias-items">
                    @foreach ($factory_products as $item)
                    <div class="media-item m-2">
                        <div class="card clickble" id="clickble">
                            <button data-uuid="${uuid}" class="btn btn-sm btn-danger delete-media"><i class="fa fa-remove"></i> Delete
                            </button>
                            @if ( $item->images->first())
                            <img src="{{ $item->full_url }}"
                                 data-name="{{$item->name}}"
                                  alt="Snow">  
                                  @endif            
                                  <div class="card-footer" >
                                      {{-- <h1 style="color: red">{{ dd($item->category )}}</h1> --}}
                                      <h1>{{ $item->name }}</h1><br> 
                                      <h3 class="form-controll"> Price : {{ $item->price }}</h3><br>
                                      <small class="text-muted">{{$item->updated_at}}</small>
                                      <a href="{{route('factory.show',$item->id)}}"  class="btn btn-success mx-auto">Full Specification</a>           
                            </div>
                        </div>
                    </div>
                    @endforeach
                
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts_lib')
    <!-- select2 -->
    <script src="{{asset('plugins/select2/select2.min.js')}}"></script>
    {{-- <script src="{{asset('plugins/dropzone/dropzone.js')}}"></script> --}}
    {{-- <script type="text/javascript">
        Dropzone.autoDiscover = false;
    </script> --}}
    {{-- <script>
        $("#filter").change(function () {
            $( "#filterForm" ).submit();
            // var selectedValue = $(this).children('option:selected');
            // var optionClass = selectedValue.attr('class');
            // var e = document.getElementById("filter");
            // var strUser = e.options[e.selectedIndex].text;
            // console.log( strUser)
            // $.ajax({
            //     data: {"category":strUser},
            //     success:function (result) {
            //         $("#page").html(result.view);                },
            //     error:function (errors) {
            //         console.log(errors);
            //     }
            // });
        });
    </script> --}}
@endpush 

