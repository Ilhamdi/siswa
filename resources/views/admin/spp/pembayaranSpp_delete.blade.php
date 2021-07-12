@extends('adminlte::page')

@section('title', 'Daftar Pembayaran Biaya')

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
            <h1 class="m-0 text-dark">Hapus Transaksi Pembayaran SPP</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
              <li class="breadcrumb-item active">Hapus Pembayaran SPP</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  
@stop

@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Hapus Transaksi Pembayaran SPP</h3>
      
  </div>


<div class="card-body">
<div class="row">
            <div class="col-md-8">
              <div class="box">
              
                  <div class="box-header">
                    <h3 class="box-title">Hapus Data Pembayaran siswa <a href="{{route('payment.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body ">
                    <div class="x_content">
                    <p>Apakah Anda yakin akan menghapus data Transaksi SPP atas nama <strong>{{$gropPayment->siswa->nama}}</strong></p>

                    <form method="POST" action="{{ route('grouppayment.destroy', $gropPayment->id) }}">
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                </div>

                   
                  </div>
                  <!-- /.box-body -->
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
    console.log('Hi!'); 
</script>
@stop