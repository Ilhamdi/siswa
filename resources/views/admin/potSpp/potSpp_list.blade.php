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
            <h1 class="m-0 text-dark">Potongan SPP Siswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
              <li class="breadcrumb-item active">Pot. SPP</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  
@stop

@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Potongan SPP Siswa</h3>
      <div class="card-tools">
        
        <a class="btn btn-primary" href="{{ route('Potspps.create') }}"> Tambah Potongan</a>
      </div>
  </div>


<div class="card-body">
  <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
            <th>No.</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Jenjang</th>
            <th>Jlh. Pot.SPP(%)</th>
            <th>Tgl.Buat</th>
            <th>status</th>
            <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
        @if (count($potSpp))
                        @php 
                        $i=1; 
                        
                        @endphp
                        @foreach($potSpp as $row)
                        @php
                        $status = 'Tidak Aktif';
                        if($row->status=='Y'){
                          $status = 'Aktif';
                        }
                        else{$status='Tidak Aktif';}
                        $tglBuat = date('d-m-Y', strtotime($row->created_at));


                        @endphp
                        <tr>
                          <td>{{$i}} </td>
                          <td>{{$row->siswa->nama}}</td>
                          <td>{{$row->siswa->kelas->namaKelas}}</td>
                          <td>{{$row->siswa->kelas->tingkat->jenjang->namaJenjang}}</td>
                          <td>{{$row->amount}} </td>
                          <td>{{$tglBuat}} </td>
                          <td>{{$status}} </td>
                          
                          <td>
                         
                          <a href="{{ route('Potspps.edit', $row->id) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i>Edit </a>
                          
                          
                          </td>
                        </tr>
                        @php $i++; @endphp
                        @endforeach
                        @endif
                        
    </tbody>
    <tfoot>
      <tr>
            <th>No.</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Jenjang</th>
            <th>Jlh. Pot.SPP(%)</th>
            <th>Tgl.Buat</th>
            <th>status</th>
            <th>Aksi</th>
      </tr>
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