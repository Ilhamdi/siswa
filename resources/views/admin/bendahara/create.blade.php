@extends('adminlte::page')

@section('title', 'Create Bendahara')

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
            <h1 class="m-0 text-dark">Create Bendahara <a href="{{url('bendahara')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h1>
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/bendahara') }}">Data Bendahara</a></li>
              <li class="breadcrumb-item active">Create Bendahara</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  
@stop

@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Create Data Bendahara</h3>
      
  </div>


<div class="card-body">
    <form method="post" action="{{ route('bendahara.store') }}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
        
      <div class="form-group{{ $errors->has('namaBendahara') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="namaBendahara">Nama Bendahara <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text"  id="namaBendahara" name="namaBendahara" class="form-control col-md-7 col-xs-12" placeholder="Nama Bendahara..." required >
            @if ($errors->has('namaBendahara'))
              <span class="help-block">{{ $errors->first('namaBendahara') }}</span>
            @endif
        </div>
      </div>

      <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ket">Alamat 
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text"  id="alamat" name="alamat" class="form-control col-md-7 col-xs-12" placeholder="alamat ..."  >
            @if ($errors->has('alamat'))
              <span class="help-block">{{ $errors->first('alamat') }}</span>
            @endif
        </div>
      </div>

      <div class="form-group{{ $errors->has('telp') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telp">Telp 
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text"  id="telp" name="telp" class="form-control col-md-7 col-xs-12" placeholder="Telp..."  >
            @if ($errors->has('telp'))
              <span class="help-block">{{ $errors->first('telp') }}</span>
            @endif
        </div>
      </div>

      <div class="form-group{{ $errors->has('jabatan') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jabatan">Jabatan 
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text"  id="jabatan" name="jabatan" class="form-control col-md-7 col-xs-12" placeholder="Jabatan..."  >
            @if ($errors->has('jabatan'))
              <span class="help-block">{{ $errors->first('jabatan') }}</span>
            @endif
        </div>
      </div>

      <div class="form-group{{ $errors->has('jenjang') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ket">Jenjang <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
        <select class="form-control" id="jenjang" name="jenjang" required>
                                        <option value="">Pilih Jenjang</option>
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