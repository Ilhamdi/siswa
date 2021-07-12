@extends('adminlte::page')

@section('title', 'Import Data Siswa')

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
            <h1 class="m-0 text-dark">Import Data Siswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
              <li class="breadcrumb-item active">Import Data Siswa</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  
@stop

@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Import Data  Siswa</h3>
      <div class="card-tools">
        
        <a class="btn btn-primary btn-xs" href="{{ route('siswa.create') }}"><i class="fa fa-plus"></i> Create Siswa</a>
        <a href="" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Import Data </a>
      </div>
  </div>


<div class="card-body">
<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h3>Import Data Siswa <a href="{{route('siswa.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h3>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form method="post" action="{{ route('importSiswa') }}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('jenjang') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kategori">Jenjang <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="jenjang" name="jenjang" autofocus required> 
                            <option value="">Pilih Jenjang</option>
                                    @if(count($jenjang))
                                        @foreach($jenjang as $row)
                                            <option value="{{$row->id}}">{{$row->namaJenjang}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('jenjang'))
                                <span class="help-block">{{ $errors->first('jenjang') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('kelas') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kelas">Kelas <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="kelas" name="kelas" required>
                                    
                                    
                                </select>
                                @if ($errors->has('kelas'))
                                <span class="help-block">{{ $errors->first('kelas') }}</span>
                                @endif
                            </div>
                        </div>

                        

                        <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                                <label for="file" class="control-label col-md-3 col-sm-3 col-xs-12">File (.xls, .xlsx)</label>
                                
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::file('file', array( 'id' => 'id-input-file-2','class' => 'form-control')) }}
                                    <p clas="help-block">Telebih dahulu Download format Data Siswa <a href="{{asset('files/format Siswa.xls')}}"> Format Siswa </a> </p>
                                </div>
                        </div>
                        
                        

                        <div class="ln_solid"></div>

                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</div>


@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    $(document).ready(function() {
            $('#jenjang').on('change',function(){
              
                var jenjangID = $(this).val();
                if(jenjangID){
                    $.ajax({
                        type:'GET',
                        url:"{{url('getKelas')}}?id="+jenjangID,
                        success:function(res){
                            if(res){
                                $("#kelas").empty();
                               // $("#kelas").append('<option>Pilih kelas</option>');
                                $.each(res,function(key,value){
                                    $("#kelas").append('<option value="'+key+'">'+value+'</option>');
                                });
                           
                            }else{
                               $("#kelas").empty();
                            }
                        }

                    });
                }else{
                    $("#kelas").empty();
                } 

            });
          }); 
</script>
@stop