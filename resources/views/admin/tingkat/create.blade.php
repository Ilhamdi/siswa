@extends('adminlte::page')

@section('title', 'Create Tingkat')

@section('content_header')
<div class="right_col" role="main">
                @include('layouts.alert')
                @if(Session::has('flash_message'))
            <div class="container">      
                <div class="alert alert-success"><em> {!! session('flash_message') !!}</em>
                </div>
            </div>
        @endif 
        
                
    </div>
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Create Tingkat <a href="{{url('tingkat')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h1>
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/tingkat') }}">Data Tingkat</a></li>
              <li class="breadcrumb-item active">Create Tingkat</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  
@stop

@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Create Data Tingkat</h3>
      
  </div>


<div class="card-body">
    <form method="post" action="{{ route('tingkat.store') }}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
        
      <div class="form-group{{ $errors->has('namaJenjang') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="namaJenjang">Nama Tingkat <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text"  id="nama" name="nama" class="form-control col-md-7 col-xs-12" placeholder="Nama Tingkat..." required >
            @if ($errors->has('nama'))
              <span class="help-block">{{ $errors->first('nama') }}</span>
            @endif
        </div>
      </div>

      <div class="form-group{{ $errors->has('jenjang') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ket">Jenjang <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
        <select class="form-control" id="jenjang" name="jenjang">
                                        <option>Pilih Jenjang</option>
                                        @if(count($jenjang))
                                            @foreach($jenjang as $row)
                                                <option value="{{$row->id}}">{{$row->namaJenjang}}</option>
                                            @endforeach
                                        @endif
                                    </select>
            @if ($errors->has('ket'))
              <span class="help-block">{{ $errors->first('jenjang') }}</span>
            @endif
        </div>
      </div>

      <div class="box-footer">
        <input type="hidden" name="_token" value="{{ Session::token() }}">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>

    </form>

</div>
  
</div>
</div>


@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!'); 
</script>
@stop