@extends('adminlte::page')

@section('title', 'Edit Siswa')

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
            <h1 class="m-0 text-dark">Edit siswa <a href="{{url('siswa')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h1>
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/siswa') }}">Data siswa</a></li>
              <li class="breadcrumb-item active">Edit siswa</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  
@stop

@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Edit Data siswa</h3>
      
  </div>


<div class="card-body">
    
    {!! Form::model($siswa, ['method' => 'PATCH','route' => ['siswa.update', $siswa->id]]) !!} 
    
    <div class="form-group{{ $errors->has('jenjang') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kategori">Jenjang <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="jenjang" name="jenjang" autofocus required>
                                    <option value="{{$siswa->kelas->tingkat->jenjang_id}}">{{$siswa->kelas->tingkat->jenjang->namaJenjang}}</option>
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
                        <div class="form-group{{ $errors->has('tingkat') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tingkat">Tingkat <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="tingkat" name="tingkat" required>
                                <option value="{{$siswa->kelas->tingkat_id}}">{{$siswa->kelas->tingkat->nama}}</option>
                                    
                                </select>
                                @if ($errors->has('tingkat'))
                                <span class="help-block">{{ $errors->first('tingkat') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('kelas') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kelas">Kelas <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="kelas" name="kelas" required>
                            <option value="{{$siswa->kelas_id}}">{{$siswa->kelas->namaKelas}}</option>
                                
                                </select>
                                @if ($errors->has('kelas'))
                                <span class="help-block">{{ $errors->first('kelas') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('nis') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">NIS <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text"  id="nis" name="nis" class="form-control col-md-7 col-xs-12" value="{{$siswa->nis}}">
                                @if ($errors->has('nis'))
                                <span class="help-block">{{ $errors->first('nis') }}</span>
                                @endif
                            </div>
                        </div>


                        <div class="modal modal-warning fade" id="modal-warning">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Warning Modal</h4>
              </div>
              <div class="modal-body">
                <p>One fine body&hellip;</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

                        <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="{{$siswa->nama}}" id="nama" name="nama" class="form-control col-md-7 col-xs-12" >
                                @if ($errors->has('nama'))
                                <span class="help-block">{{ $errors->first('nama') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Jenis Kelamin 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12 ">
                                    <select class="form-control" id="gender" name="gender">
                                      <option value="{{$siswa->gender}}">{{$siswa->gender}}</option>
                                      <option value="Laki-laki">Laki-laki</option>
                                      <option value="Perempuan">Perempuan</option>     
                                    </select>
                                    @if ($errors->has('gender'))
                                    <span class="help-block">{{ $errors->first('gender') }}</span>
                                    @endif
                                </div>
                        </div>

                        <div class="form-group{{ $errors->has('thnMasuk') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Tahun Masuk 
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="thnMasuk" name="thnMasuk" class="form-control col-md-7 col-xs-12" value="{{$siswa->thnMasuk}}" >
                                @if ($errors->has('thnMasuk'))
                                <span class="help-block">{{ $errors->first('thnMasuk') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('bapak') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bapak">Nama Bapak 
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="{{$siswa->bapak}}" id="bapak" name="bapak" class="form-control col-md-7 col-xs-12" >
                                @if ($errors->has('bapak'))
                                <span class="help-block">{{ $errors->first('bapak') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('ibu') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ibu">Nama Ibu 
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="{{$siswa->ibu}}" id="ibu" name="ibu" class="form-control col-md-7 col-xs-12" >
                                @if ($errors->has('ibu'))
                                <span class="help-block">{{ $errors->first('ibu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('hpOrtu') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hpOrtu">No. HP Orang Tua 
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="{{$siswa->hpOrtu}}" id="hpOrtu" name="hpOrtu" class="form-control col-md-7 col-xs-12" >
                                @if ($errors->has('hpOrtu'))
                                <span class="help-block">{{ $errors->first('hpOrtu') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('agama') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="agama">Agama 
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="{{$siswa->agama}}" id="agama" name="agama" class="form-control col-md-7 col-xs-12" >
                                @if ($errors->has('agama'))
                                <span class="help-block">{{ $errors->first('agama') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Alamat 
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="{{$siswa->alamat}}" id="alamat" name="alamat" class="form-control col-md-7 col-xs-12" >
                                @if ($errors->has('alamat'))
                                <span class="help-block">{{ $errors->first('alamat') }}</span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group{{ $errors->has('foto') ? ' has-error' : '' }}">
                                    <label for="foto" class="control-label col-md-3 col-sm-3 col-xs-12">Photo</label>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <img src="{{asset('images/siswa/'.$siswa->foto)}}" alt="" style="width:200px; height:200px;">
                                        {{ Form::file('foto', array( 'id' => 'id-input-file-2','class' => 'form-control')) }}
                                    </div>
                            </div>
                        
                        

                        <div class="ln_solid"></div>

                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </div>

        {!! Form::close() !!}

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

    function kelas(){
        
        var tingkatID = $("#tingkat").val();
        if(tingkatID){
            $.ajax({
                type:'GET',
                url:"{{url('getKelas')}}?id="+tingkatID,
                success:function(res){
                    if(res){
                        $("#kelas").empty();
                       // $("#kelas").append('<option value="">Pilih kelas</option>');
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
    }

    function tingkat(){
        var jenjangID = $("#jenjang").val();
        if(jenjangID){
            $.ajax({
                type:'GET',
                url:"{{url('getTingkat')}}?id="+jenjangID,
                success:function(res){
                    if(res){
                        $("#tingkat").empty();
                        
                        $.each(res,function(key,value){
                            $("#tingkat").append('<option value="'+key+'">'+value+'</option>');
                        });
                
                    }else{
                    $("#tingkat").empty();
                    }
                }

            });
        }else{
            $("#tingkat").empty();
        }
    }

    $(document).ready(function() {
        kelas();
        tingkat();

    $('#jenjang').on('change',function(){
        tingkat();
         

    });

    $('#tingkat').on('change',function(){
    
        kelas();

    });


$('#nis').on('change',function(){
    //alert($(this).val());
    var nis = $(this).val();
    if(nis){
        $.ajax({
            type:'GET',
            url:"{{url('cekNis')}}?id="+nis,
            success: function(res){
                if(res.length > 0){
                    alert("NIS sudah Ada");
                     $("#nis").val('');
                     $("#nis").empty();

                }
            }

        });
    }
})



});
</script>
@stop