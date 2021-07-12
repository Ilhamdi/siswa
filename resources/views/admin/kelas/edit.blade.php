@extends('adminlte::page')

@section('title', 'Edit kelas')

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
            <h1 class="m-0 text-dark">Edit kelas <a href="{{url('kelas')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h1>
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/kelas') }}">Data kelas</a></li>
              <li class="breadcrumb-item active">Edit kelas</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  
@stop

@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Edit Data kelas</h3>
      
  </div>


<div class="card-body">
    <!-- <form method="post" action="" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data"> -->
    {!! Form::model($kelas, ['method' => 'PATCH','route' => ['kelas.update', $kelas->id]]) !!}   
    

    <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
        <label for="Kelas">Nama Kelas</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" class="form-control" id="nama" name='nama' value="{{$kelas->namaKelas}}">
                @if ($errors->has('nama'))
                    <span class="help-block">{{ $errors->first('nama') }}</span>
                @endif
        </div>
     </div>
    <div class="form-group{{ $errors->has('waliKelas') ? ' has-error' : '' }}">
        <label for="Kelas">Nama Wali Kelas</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" class="form-control" id="waliKelas" name='waliKelas' value="{{$kelas->waliKelas}}">
            @if ($errors->has('waliKelas'))
                <span class="help-block">{{ $errors->first('waliKelas') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('jenjang') ? ' has-error' : '' }}">
        <label for="Kelas">Tingkatan Kelas</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="form-control" id="tingkat" name="tingkat">
            <option value="{{$kelas->tingkat_id}}">{{$kelas->tingkat->nama}}</option>
                    @if(count($tingkat))
                        @foreach($tingkat as $row)
                            <option value="{{$row->id}}">{{$row->nama}}</option>
                        @endforeach
                    @endif
            </select>
        </div>
    </div>
    <div class="form-group{{ $errors->has('desk') ? ' has-error' : '' }}">
        <label for="Kelas" >Deskripsi</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" class="form-control" id="desk" name='desk' value="{{$kelas->deskripsi}}">
                @if ($errors->has('desk'))
                    <span class=" help-block">{{ $errors->first('desk') }}</span>
                @endif
        </div>
    </div>

      <div class="box-footer">
        <input type="hidden" name="_token" value="{{ Session::token() }}">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>

      {!! Form::close() !!}
    <!-- </form> -->

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