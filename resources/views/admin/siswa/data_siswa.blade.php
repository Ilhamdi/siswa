@extends('adminlte::page')

@section('title', 'Data Siswa')

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
            <h1 class="m-0 text-dark">Data Siswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
              <li class="breadcrumb-item active">Data Siswa</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  
@stop

@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data  Siswa</h3>
      <div class="card-tools">
        
        <a class="btn btn-primary btn-xs" href="{{ route('siswa.create') }}"><i class="fa fa-plus"></i> Create Siswa</a>
        <a href="{{route('importSiswa')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Import Data </a>
        
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
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    @if (count($datasiswa))
                  @php $i=1; @endphp
                  @foreach($datasiswa as $row)

                  <tr>
                    <td width='10px'>{{$i}}. </td>
                    <td>{{$row->nama}}</td>
                    <td>{{$row->namaKelas}} </td>
                    <td>{{$row->namaJenjang}}  </td>
                    
                    <td>
                    <a href="" class="btn btn-info btn-xs"> SPP</a>
                    <a href="{{ route('siswa.edit',$row->id) }}" class="btn btn-info btn-xs">Edit </a>
                    
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
        <th>Action</th>
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