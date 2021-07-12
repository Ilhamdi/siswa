@extends('adminlte::page')

@section('title', 'Set Biaya')

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
            <h1 class="m-0 text-dark">Set Biaya  <a href="{{url('/setSpp')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h1>
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/setSpp') }}">Besaran Biaya</a></li>
              <li class="breadcrumb-item active">Set Biaya</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  
@stop

@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Set Data Biaya</h3>
      
  </div>


<div class="card-body">
    <form method="post" action="{{ route('setSpp.store') }}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
        
      <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama Biaya <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text"  id="nama" name='nama' class="form-control col-md-7 col-xs-12" placeholder="Nama Biaya..." required >
            @if ($errors->has('nama'))
              <span class="help-block">{{ $errors->first('nama') }}</span>
            @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('tingkat') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tingkat">Tingkat <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
        <select class="form-control" id="tingkat" name="tingkat" required>
            <option value="">Pilih tingkat</option>
                @if(count($tingkat))
                    @foreach($tingkat as $row)
            <option value="{{$row->id}}">{{$row->nama}}</option>
                    @endforeach
                @endif
        </select>
            @if ($errors->has('tingkat'))
              <span class="help-block">{{ $errors->first('tingkat') }}</span>
            @endif
        </div>
      </div>

      <div class="form-group{{ $errors->has('thnAjaran') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="thnAjaran">Tahun Ajaran <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right" id="thnAjaran" name="thnAjaran" readonly>
                  </div>
        </div>
      </div>

      <div class="form-group{{ $errors->has('jns') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jns">Tingkat <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
        <select class="form-control" id="jns" name="jns" required>
            <option value="">Jenis Biaya</option>
            @if(count($jnsBiaya))
                @foreach($jnsBiaya as $row)
            <option value="{{$row->id}}">{{$row->namaBiaya}}</option>
                @endforeach
            @endif
        </select>
            @if ($errors->has('jns'))
              <span class="help-block">{{ $errors->first('jns') }}</span>
            @endif
        </div>
      </div>

      <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="amount">Jumlah <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text"  id="amount" name='amount' class="form-control col-md-7 col-xs-12" placeholder="jumlah..." required >
            @if ($errors->has('amount'))
              <span class="help-block">{{ $errors->first('amount') }}</span>
            @endif
        </div>
      </div>
      <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Status <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="form-control" id="status" name="status">
                <option value="Y">Aktif</option>
                <option value="N">Non-Aktif</option>
                                            
            </select>
            @if ($errors->has('status'))
              <span class="help-block">{{ $errors->first('status') }}</span>
            @endif
        </div>
      </div>

      <div class="form-group{{ $errors->has('desk') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desk">Keterangan <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text"  id="desk" name='desk' class="form-control col-md-7 col-xs-12" placeholder="Keterangan..." required >
            @if ($errors->has('desk'))
              <span class="help-block">{{ $errors->first('desk') }}</span>
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
@section('plugins.DateRangePicker', true)

<!-- bootstrap datepicker -->
<script>
    //console.log('Hi!')
    function ta(){
            var d = new Date();
            var ta;
            if(d.getMonth()>5){
                ta = (d.getFullYear())+"/"+(d.getFullYear()+1); 
            }
            else {
                ta = (d.getFullYear()-1)+"/"+(d.getFullYear()); 
            }
            return ta;
        }
    $(function () {

        var x = ta();
        $("#thnAjaran").val(x);

        // $('#thnAjaran').daterangepicker({
            
        //     locale: {
        //         format: 'YYYY'
        //     }
        // })

    })
    
</script>
@stop