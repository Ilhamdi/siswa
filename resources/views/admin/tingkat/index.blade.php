@extends('adminlte::page')

@section('title', 'Tingkat')

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
            <h1 class="m-0 text-dark">Tingkat Pendidikan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
              <li class="breadcrumb-item active">Data Tingkat</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  
@stop

@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Tingkat Kelas</h3>
      <div class="card-tools">
        
        <a class="btn btn-primary" href="{{ route('tingkat.create') }}"> Create Tingkat</a>
      </div>
  </div>


<div class="card-body">
  <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Tingkat</th>
        <th>Jenjang</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($data as $key => $tingkat)
      <tr>
        <td>{{ $tingkat->nama }}</td>
        <td>{{ $tingkat->jenjang->namaJenjang }}</td>
        <td>
          <a class="btn btn-primary" href="{{ route('tingkat.edit',$tingkat->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['tingkat.destroy', $tingkat->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
      <th>Tingkat</th>
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