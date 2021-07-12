@extends('adminlte::page')

@section('title', 'Buat Potongan Biaya')

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
            <h1 class="m-0 text-dark">Besaran Potongan SPP <a href="{{url('Potspps')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h1>
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/Potspps') }}">Data Potongan Siswa</a></li>
              <li class="breadcrumb-item active">Tambah Besaran Pot.SPP</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  
@stop

@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Tambah Besaran Pot.SPP</h3>
      
  </div>


<div class="card-body">
    <form method="post" action="{{ route('Potspps.store') }}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">

    <div class="form-group{{ $errors->has('nis') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">Tingkat <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="form-control select2" style="width: 100%;" id="tingkat" name="tingkat" autofocus>
                <option selected="">Pilih Tingkat</option>
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
                <input type="text" class="form-control" id="nis" name="nis" required>
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
                <option value="" selected="selected">Ketik & Pilih nama siswa...</option>
                
            </select>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jenjang">Jenjang 
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text"  id="jenjang" name="jenjang" class="form-control col-md-7 col-xs-12" readonly >
            
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kelas">Kelas
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text"  id="kelas" name="kelas" class="form-control col-md-7 col-xs-12" readonly >
            <input type="hidden" class="form-control" id="idSiswa" name="idSiswa" >
        </div>
      </div>

      <div class="form-group{{ $errors->has('pot') ? ' has-error' : '' }}">
        <label class="control-label col-md-6 col-sm-6 col-xs-12" for="ket">Besaran Potongan SPP (dlm persen(%)) <span class="required">*</span>
        </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="input-group">
                  
                  <input type="text" class="form-control" id="pot" name="pot" required>
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
            <input type="text"  id="amount" name="amount" class="form-control col-md-7 col-xs-12" value="0" readonly >
            <input type="hidden" class="form-control" id="tempPot" >
        </div>
      </div>

      <div class="form-group{{ $errors->has('pot') ? ' has-error' : '' }}">
        <label class="control-label col-md-6 col-sm-6 col-xs-12" for="ket">Status <span class="required">*</span>
        </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
            <select class="form-control" id="status" name="status">
                <option value="Y">Aktif</option>
                <option value="N">Non-Aktif</option>
                                            
            </select>
            @if ($errors->has('pot'))
              <span class="help-block">{{ $errors->first('pot') }}</span>
            @endif
        </div>
      </div>

      <div class="form-group{{ $errors->has('ket') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ket">Keterangan <span class="required">*</span>
        </label>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <input type="text"  id="ket" style="width: 100%;" name="ket" class="form-control col-md-7 col-xs-12" placeholder="Keterangan ..." required >
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