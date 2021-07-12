@extends('adminlte::page')

@section('title', 'Potongan SPP')

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
            <h1 class="m-0 text-dark">Setoran SPP
        <small>Setoran SPP {{$jenjang->namaJenjang}} </small></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
              <li class="breadcrumb-item active">Setoran SPP</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  
@stop

@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Detail Setoran SPP
        <small>Setoran SPP {{$jenjang->namaJenjang}} </small></h3>
      
  </div>


<div class="card-body">

<table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                              <th style="width: 10%">#</th>
                              <th>Nama</th>
                              <th>Kelas</th>
                              <th>Total Bayar (Rp.)</th>
                              <th>Tgl. Bayar</th>
                            </tr>
                            </thead>    
                         <tbody>
                            @php 
                              $i=1; 
                              $tot=0; 

                            @endphp
                            @if (count($spp))
                            
                            @foreach($spp as $row)

                            <tr>
                              <td>{{$i}}. </td>
                              <td>{{$row->nama}} </td>
                              <td> {{$row->namaKelas}}</td>
                              @php
                                $selisih = 0;
                               // $selisih = ($row->pot * $row->total)/100;
                                $totBayar = $row->total - $selisih;

                              @endphp
                              <td align="right">{{number_format($totBayar,0,',','.')}} 
                                 


                              </td>
                              <td>{{$row->created_at}} 
                                @php 
                                       if($row->pot>0)
                                       { 

                                      @endphp

                                      <i>(pot.{{$row->pot}}%) </i>
                                      @php
                                        }

                                      @endphp

                              </td>
                              

                              
                              
                            </tr>
                            @php $i++; 
                                 
                                 $tot=$tot + $totBayar;
                                 
                            @endphp
                            @endforeach
                            @endif
                            
                            </tbody>
                            <tfoot>
                            <tr>
                              <th style="width: 10%">#</th>
                              <th>Nama</th>
                              <th>Total Bayar (Rp.)</th>
                              <th>{{number_format($tot,0,',','.')}} </th>
                              <th>Tgl. Bayar</th>
                            </tr>
                            </tfoot>  

                          </table>
  
</div>
</div>

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Setoran SPP
        <small>Setoran SPP {{$jenjang->namaJenjang}} </small></h3>
      
  </div>
<div class="card-body">
<div class="col-md-10">
                <div class="box box-danger">
                    <div class="box-header">
                      <h3 class="box-title">Setoran SPP</h3>
                    </div>
                    <div class="box-body">
                    	
                        <form method="post" action="{{ route('setoran.store') }}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                        
			                <!-- /.input group -->
			              
			              

                        <div class="form-group{{ $errors->has('desk') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desk">Keterangan <span class="required">*</span>
                            </label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input type="text"  id="desk" style="width: 100%;" name="desk" class="form-control col-md-7 col-xs-12" placeholder="Keterangan ..." required >
                                @if ($errors->has('desk'))
                                <span class="help-block">{{ $errors->first('desk') }}</span>
                                @endif
                            </div>
                        </div>
                        
                        

			              <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                    
                            <label for="amount">Jumlah SETORAN </label>
                            <div class="input-group col-md-12 col-sm-12 col-xs-12">
                                <span class="input-group-addon">Rp.</span>
                                <input type="text" id="amountTot" name="amount" value="{{number_format($tot,0,',','.')}} " class="form-control col-md-7 col-xs-12" readonly>
                                 
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