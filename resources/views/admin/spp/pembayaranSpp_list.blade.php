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
            <h1 class="m-0 text-dark">Daftar Pembayaran Biaya</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
              <li class="breadcrumb-item active">Pembayaran Biaya</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  
@stop

@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Pembayaran Biaya</h3>
      <div class="card-tools">
        
        <a class="btn btn-primary" href="{{route('payment.create')}}"> Buat Baru</a>
      </div>
  </div>


<div class="card-body">
  <table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th style="width: 10%">#</th>
            <th>Nama</th>
            <th>Total Bayar (Rp.)</th>
            <th>Tgl. Bayar</th>
            <th>Status</th>
            <th style="width: 20%">Aksi</th>
        </tr>
    </thead>
    <tbody>
    @php $i=1; $total=0; @endphp
        @if (count($spp))
                                

            @foreach($spp as $row)
                <tr>
                    <td>{{$i}}. </td>
                    <td>{{$row->siswa->nama}} </td>

                    @php
                    $total = $total + $row->totalBayar;
                    

                    @endphp
                    <td align='right'>{{number_format($row->totalBayar,0,',','.')}} </td>
                    <td>{{date('d-m-Y  h:i:s A',strtotime($row->created_at))}} </td>
                    <td>
                        @php
                        if($row->status == 'sdhSetor')
                        {
                            echo "<span class='label label-success'>Setor</span>";
                        }
                        else
                        {
                            echo "<span class='label label-danger'>Belum disetor</span>";
                        }
                        $i++;
                        @endphp
                        
                                     
                                  </td>
                                  <td>
                                  <a href="{{ route('grouppayment.edit', $row->id) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>Edit </a>
                                  <a href="{{ route('grouppayment.show', $row->id) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i>Hapus </a>
                                  </td>
                                </tr>
                                
              @endforeach
          
                
    </tbody>
    <tfoot>
      <tr>
      <th style="width: 10%">#</th>
            <th>Total </th>
            <th>Rp. {{number_format($total,0,',','.')}},.</th>
            <th>Tgl.Bayar</th>
            <th>Status</th>
            <th style="width: 20%">Aksi</th>
      </tr>
      @endif
    </tfoot>
  </table>
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