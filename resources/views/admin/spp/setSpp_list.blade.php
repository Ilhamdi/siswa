@extends('adminlte::page')

@section('title', 'Besaran Jumlah SPP')

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
            <h1 class="m-0 text-dark">Besaran Jumlah SPP</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
              <li class="breadcrumb-item active">Set SPP</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  
@stop

@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Besaran Jumlah SPP</h3>
      <div class="card-tools">
        
        <a class="btn btn-primary" href="{{ route('setSpp.create') }}"> Setting Besaran SPP</a>
      </div>
  </div>


<div class="card-body">
  <table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th style="width: 10%">#</th>
            <th>Nama</th>
            <th>Tingkatan</th>
            <th>Jenjang</th>
            <th>Jumlah (Rp.)</th>
            <th style="width: 20%">Aksi</th>
        </tr>
    </thead>
    <tbody>
    @if (count($spp))
                @php $i=1; @endphp
                @foreach($spp as $row)
                <tr>
                  <td>{{$i}}. </td>
                  <td>{{$row->nama}} </td>
                  <td>{{$row->tingkat->nama}} </td>
                  <td>{{$row->tingkat->jenjang->namaJenjang}} </td>
                  <td>{{number_format($row->amount,2,',','.')}} </td>
                  
                  
                  <td>
                  
                  <a href="{{ route('setSpp.edit', $row->id) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>Edit </a>
                  {!! Form::open(['method' => 'DELETE','route' => ['setSpp.destroy',$row->id],'style'=>'display:inline']) !!}
                  {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                  {!! Form::close() !!}
                  </td>
                </tr>
                @php $i++; @endphp
                @endforeach
                
    </tbody>
    <tfoot>
      <tr>
      <th style="width: 10%">#</th>
            <th>Nama</th>
            <th>Tingkatan</th>
            <th>Jenjang</th>
            <th>Jumlah (Rp.)</th>
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