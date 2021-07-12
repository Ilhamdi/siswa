@extends('adminlte::page')

@section('title', 'Create Jenjang')

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
            <h1 class="m-0 text-dark">Create Jenjang <a href="{{url('jenjang')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h1>
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/jenjang') }}">Data Jenjang</a></li>
              <li class="breadcrumb-item active">Create Jenjang</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  
@stop

@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Create Data Jenjang</h3>
      
  </div>


<div class="card-body">
    <form method="post" action="{{ route('jenjang.store') }}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
        
      <div class="form-group{{ $errors->has('namaJenjang') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="namaJenjang">Nama Jenjang <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text"  id="namaJenjang" name="namaJenjang" class="form-control col-md-7 col-xs-12" placeholder="Nama Jenjang..." required >
            @if ($errors->has('namaJenjang'))
              <span class="help-block">{{ $errors->first('namaJenjang') }}</span>
            @endif
        </div>
      </div>

      <div class="form-group{{ $errors->has('ket') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ket">Keterangan <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text"  id="ket" name="ket" class="form-control col-md-7 col-xs-12" placeholder="Keterangan ..." required >
            @if ($errors->has('ket'))
              <span class="help-block">{{ $errors->first('ket') }}</span>
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