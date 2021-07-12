@extends('adminlte::page')

@section('title', 'Edit Potongan Biaya')

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
            <h1 class="m-0 text-dark">Edit Besaran Potongan SPP <a href="{{url('Potspps')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h1>
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/Potspps') }}">Data Potongan Siswa</a></li>
              <li class="breadcrumb-item active">Edit Besaran Pot.SPP</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  
@stop

@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Edit Besaran Pot.SPP</h3>
      
  </div>


<div class="card-body">
    {!! Form::model($potSpp, ['method' => 'PATCH','route' => ['Potspps.update', $potSpp->id]]) !!}

    <div class="form-group{{ $errors->has('nis') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">Tingkat <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="form-control select2" style="width: 100%;" id="tingkat" name="tingkat" >
                <option selected="">{{$potSpp->siswa->kelas->tingkat->nama}}</option>
                @if(count($tingkat))
                    @foreach($tingkat as $row)
                <option value="{{$row->id}}">{{$row->nama}}</option>
                    @endforeach
                @endif
            </select>
        </div>
      </div>
        
      <div class="form-group{{ $errors->has('nis') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">NIS <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="input-group input-group-sm">
                <input type="text" class="form-control" id="nis" name="nis" value="{{$potSpp->siswa->nis}}">
                <span class="input-group-append">
                    <button type="button" class="btn btn-info btn-flat" id="nisbtn">Cari!</button>
                </span>
            </div>
        </div>
      </div>
      <div class="form-group{{ $errors->has('nis') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">Nama <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="form-control select2" style="width: 100%;" id="nama" name="nama">
                <option value="{{$potSpp->siswa_id}}" selected="selected">{{$potSpp->siswa->nama}}</option>
                
            </select>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jenjang">Jenjang 
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text"  id="jenjang" name="jenjang" class="form-control col-md-7 col-xs-12" value="{{$potSpp->siswa->kelas->tingkat->jenjang->namaJenjang}}" readonly >
            
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kelas">Kelas
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text"  id="kelas" name="kelas" class="form-control col-md-7 col-xs-12" value="{{$potSpp->siswa->kelas->namaKelas}}" readonly >
            <input type="hidden" class="form-control" id="idSiswa" name="idSiswa" value="{{$potSpp->siswa_id}}" >
        </div>
      </div>

      <div class="form-group{{ $errors->has('pot') ? ' has-error' : '' }}">
        <label class="control-label col-md-6 col-sm-6 col-xs-12" for="ket">Besaran Potongan SPP (dlm persen(%)) 
        </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="input-group">
                  
                  <input type="text" class="form-control" id="pot" name="pot" value="{{$potSpp->amount}}">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="fas fa-percen-sign">%</i>
                    </span>
                  </div>
                  
            </div>
            
            @if ($errors->has('pot'))
              <span class="help-block">{{ $errors->first('pot') }}</span>
            @endif
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kelas">Besar Biaya SPP
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text"  id="amount" name="amount" class="form-control col-md-7 col-xs-12" value="{{$spp}}" readonly >
            <input type="hidden" class="form-control" id="tempPot" value="{{$setspp}}">
        </div>
      </div>

      <div class="form-group{{ $errors->has('pot') ? ' has-error' : '' }}">
        <label class="control-label col-md-6 col-sm-6 col-xs-12" for="ket">Status <span class="required">*</span>
        </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
            <select class="form-control" id="status" name="status">
                <option value="{{$potSpp->status}}">{{$potSpp->status}}</option>
                <option value="Y">Aktif</option>
                <option value="N">Non-Aktif</option>
                                            
            </select>
            @if ($errors->has('pot'))
              <span class="help-block">{{ $errors->first('pot') }}</span>
            @endif
        </div>
      </div>

      <div class="form-group{{ $errors->has('ket') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ket">Keterangan 
        </label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <input type="text"  id="ket" style="width: 100%;" name="ket" class="form-control col-md-7 col-xs-12" placeholder="Keterangan ..." value="{{$potSpp->desk}}" >
            @if ($errors->has('ket'))
              <span class="help-block">{{ $errors->first('ket') }}</span>
            @endif
        </div>
      </div>
      
      <div class="box-footer">
        <input type="hidden" name="_token" value="{{ Session::token() }}">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-sm">
                  Launch Small Modal
                </button>
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
    
    $(document).ready(function() {
        //$( '#amount' ).mask('000.000.000', {reverse: true});

        $('#pot').on('change',function(){
          var pot = $(this).val();
          
          var biaya = $("#tempPot").val();
          //alert(biaya);
          if(biaya){
            var potongan = biaya - ((pot/100)*biaya);
            $("#amount").val(potongan);
          }
          else {
            alert('Isikan NIS atau nama terlebih dahulu.');
          }
        });
        $('#tingkat').on('change',function(){
  
            var tingkatID = $(this).val();
            if(tingkatID){
                $.ajax({
                    type:'GET',
                    url:"{{url('getSiswa')}}?id="+tingkatID,
                    success:function(res){
                        if(res){
                            $("#nama").empty();
                            $("#nama").append('<option value="">Pilih nama</option>');
                            $.each(res,function(key,value){
                                $("#nama").append('<option value="'+key+'">'+value+'</option>');
                            });
                        
                        }else{
                            $("#nama").empty();
                        }
                    }

                });
            }else{
                $("#nama").empty();
            } 

        });

      $('#nama').on('change',function(){
        var idSiswa = $(this).val();
        
        //alert(idSiswa);
        if(idSiswa){
                $.ajax({
                    type:'GET',
                    url: "{{url('getNama')}}?id="+idSiswa,
                    success:function(res){
                        //alert(res.nis);
                        if(res){
                            $("#nis").val(res.nis);
                            $("#idSiswa").val(res.id);
                            $("#kelas").val(res.namaKelas);
                            $("#jenjang").val(res.namaJenjang);
                            $("#amount").val(res.a);
                            $("#tempPot").val(res.a);
                        }
                    }

                });
            }
      });

      $('#nisbtn').on('click',function(){
            var idSiswa = $('#nis').val();
            //alert(idSiswa);
            if(idSiswa){
                $.ajax({
                    type:'GET',
                    url: "{{url('getNama')}}?id="+idSiswa,
                    success:function(res){
                      //  alert(res.nama);
                        if(res){
                            $("#nama").empty();
                            $("#nama").append('<option value="'+res.nis+'">'+res.nama+'</option>');
                            $("#idSiswa").val(res.id);
                            $("#kelas").val(res.namaKelas);
                            $("#jenjang").val(res.namaJenjang);
                            $("#amount").val(res.a);
                            $("#tempPot").val(res.a);
                        }
                    }

                });
            }
            
        });

        

    });
</script>
@stop