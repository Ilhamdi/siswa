@extends('adminlte::page')

@section('title', 'Create Roles')

@section('content_header')

<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Create New Role <a href="{{url('roles')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h1>
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/roles') }}">Data Roles</a></li>
              <li class="breadcrumb-item active">Create New Role</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  
@stop

@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Create Data Roles</h3>
      
  </div>


<div class="card-body">
    <form method="post" action="{{ route('roles.store') }}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
        
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">Nama <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text"  id="name" name="name" class="form-control col-md-7 col-xs-12" placeholder="Nama Role ..." required >
            @if ($errors->has('name'))
              <span class="help-block">{{ $errors->first('name') }}</span>
            @endif
        </div>
      </div>

      <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Permission:</strong>
            <br/>
            @foreach($permission as $value)
                <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                {{ $value->name }}</label>
            <br/>
            @endforeach
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
</script>
@stop