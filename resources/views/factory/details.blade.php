@extends('layouts.app')
@push('css_lib')
    <!-- select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/select2.min.css')}}">
    {{--dropzone--}}
    <link rel="stylesheet" href="{{asset('plugins/dropzone/bootstrap.min.css')}}">
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{!! trans('lang.media_title') !!} <small>{{trans('lang.media_desc')}}</small></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i class="fa fa-dashboard"></i> {{trans('lang.dashboard')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('lang.medias')}}</li>
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
                        <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>{{ $factory->name }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{!! url('factory') !!}"><i class="fa fa-list mr-2"></i>All products</a>
                    </li>
                    @hasanyrole('admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{!! url('factory/create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.media_create')}}</a>
                        </li>                        
                    @endhasanyrole
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{!! url('factory') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.media_all')}}</a>
                    </li> --}}
                    {{-- <div class="ml-auto d-inline-flex">
                        <li class="nav-item">
                            <div style="width: 200px;" id="selectCollection" class="ml-auto pb-2 mx-2">
                                <select name="collection_name" id="collectionName" class="form-control-sm form-control select2"> </select>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pt-1 pb-35" data-size="150" href="#"><i class="fa fa-th"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pt-1 pb-35" data-size="200" href="#"><i class="fa fa-th-large"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pt-1 pb-35" data-size="300" href="#"><i class="fa fa-square"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pt-1 pb-35" id="refreshMedia" href="#"><i class="fa fa-refresh"></i> {{trans('lang.refresh')}}</a>
                        </li>
                    </div> --}}
                </ul>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h6 class="success">ID : <span>{{ $factory->id }}</span></h6>
                    </div>
                    <div class="col-6">
                        <h6 class="success">Name : <span>{{ $factory->name }}</span></h6>
                    </div>
                    <div class="col-6">
                        <h6 class="success">Description : <span>{!! $factory->description!!}</span></h6>                    
                    </div>
                    <div class="col-6">
                        <h6 class="success">Price : <span>{{ $factory->price }}</span></h6>                  
                    </div>
                    <div class="col-6">
                        <h6 class="success">Gender : <span>{{ $factory->gender }}</span></h6>                
                    </div>
                    <div class="col-6">
                        <h6 class="success">category: <span>{{ $factory->category->first()->name }}</span></h6>
                    </div>
                    <div class="col-6">
                        <h6 class="success">Color: <span>{{ $factory->colorcategory->first()->name }}</span></h6>
                    </div>
                    <div class="col-6">
                        <h6 class="success">created date : <span>{{ $factory->created_at }}</span></h6>      
                    </div>
                </div>
                
                <div class="row medias-items">
                    @foreach ($factory->images as $item)
                    <div class="media-item m-2">
                        <div class="card clickble">
                            <button data-uuid="${uuid}" class="btn btn-sm btn-danger delete-media"><i class="fa fa-remove"></i> Delete
                            </button>
                            <img src="{{ $item->full_url }}" alt="Snow" width="100%" >              
                            <div class="card-footer">
                                <h1>{{ $item->name }}</h1><br> <small class="text-muted">{{$item->updated_at}}</small>
                            </div>
                        </div>
                        {{-- <a href="{{route('factory.show',$item->id)}}">Full Specification</a>            --}}
                    </div>
                    @endforeach
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection
@push('scripts_lib')
    <!-- select2 -->
    <script src="{{asset('plugins/select2/select2.min.js')}}"></script>
    <script src="{{asset('plugins/dropzone/dropzone.js')}}"></script>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
    </script>
@endpush 
