@extends('adminlte::page')

@section('title', 'Pembayaran SPP')

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
            <h1 class="m-0 text-dark">Pembayaran SPP  <a href="{{route('payment.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h1>
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('payment.index')}}">Pembayaran Biaya</a></li>
              <li class="breadcrumb-item active">Set Pembayaran SPP</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  
@stop

@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Siswa</h3>
      
  </div>


<div class="card-body">
    <form method="post" action="{{ route('payment.store') }} " data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
        
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
                @if(count($siswa))
                    @foreach($siswa as $row)
                    <option value="{{$row->id}}">{{$row->nama}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>

    
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jenjang">Jenjang 
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text"  id="jenjang" name="jenjang" class="form-control col-md-7 col-xs-12" value="" readonly >
            
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kelas">Kelas
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text"  id="kelas" name="kelas" class="form-control col-md-7 col-xs-12" value="" readonly >
            <input type="hidden" class="form-control" id="idKelas" name="idKelas" value="" >
            <input type="hidden" class="form-control" id="idSiswa" name="idSiswa" value="" >
        </div>
      </div>

    <div class="form-group{{ $errors->has('thnAjaran') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="thnAjaran">Tahun Ajaran <span class="required">*</span>
        </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
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

      <div class="form-group{{ $errors->has('pot') ? ' has-error' : '' }}">
        <label class="control-label col-md-6 col-sm-6 col-xs-12" for="ket">Besaran Potongan SPP (dlm persen(%)) 
        </label>
        <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="input-group">
                  
                  <input type="text" class="form-control" id="pot" name="pot" value="0" readonly>
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
            <input type="hidden" class="form-control" id="tempPot" value="">
        </div>
      </div>

      <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
        <label for="amount">Keterangan Transaksi </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="desk" name="desk" class="form-control" placeholder="Isikan Keterangan Transaksi " required>
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

        $('#nisbtn').on('click',function(){
            var idSiswa = $('#nis').val();
            //alert(idSiswa);
            if(idSiswa){
                $.ajax({
                    type:'GET',
                    url: "{{url('getNama')}}?id="+idSiswa,
                    success:function(res){
                        //alert(res.c);
                        if(res){
                            var jlh2=0,totBayar=0;
                            if (res.b){ 
                             jlh2 = res.b;
                             totBayar = ((res.b/100)*res.a);
                            }
                            $("#nama").empty();
                            $("#nama").append('<option value="'+res.nis+'">'+res.nama+'</option>');
                            $("#idSiswa").val(res.id);
                            $("#kelas").val(res.namaKelas);
                            $("#idKelas").val(res.c);
                            $("#jenjang").val(res.namaJenjang);
                            $("#amount").val(res.a - totBayar);
                            $("#tempPot").val(res.a);
                            $("#pot").val(res.b);
                        }
                    }

                });
            }
            
        });

        $('#nama').on('change',function(){
        var idSiswa = $('#nama').val();
        
        //alert(idSiswa);
        if(idSiswa){
                $.ajax({
                    type:'GET',
                    url: "{{url('getNama')}}?id="+idSiswa,
                    success:function(res){
                        //alert(res.nis);
                        if(res){
                            var jlh2=0,totBayar=0;
                            if (res.b){ 
                             jlh2 = res.b;
                             totBayar = ((res.b/100)*res.a);
                            }
                            $("#nis").val(res.nis);
                            $("#idSiswa").val(res.id);
                            $("#kelas").val(res.namaKelas);
                            $("#idkelas").val(res.c);
                            $("#jenjang").val(res.namaJenjang);
                            $("#amount").val(res.a - totBayar);
                            $("#tempPot").val(res.a);
                            $("#pot").val(res.b);
                        }
                    }

                });
            }
      });

    })
    
</script>
@stop