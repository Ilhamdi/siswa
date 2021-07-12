@extends('adminlte::page')

@section('title', 'Dashboard')

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
            <h1 class="m-0 text-dark">Create New User <a href="{{url('users')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h1>
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/users') }}">Data User</a></li>
              <li class="breadcrumb-item active">Create New User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  
@stop

@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Create Data User</h3>
      
  </div>


<div class="card-body">
    <form method="post" action="{{ route('users.store') }}" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
        
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">Nama <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text"  id="name" name="name" class="form-control col-md-7 col-xs-12" placeholder="Nama ..." required >
            @if ($errors->has('name'))
              <span class="help-block">{{ $errors->first('name') }}</span>
            @endif
        </div>
      </div>

      <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">Username <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text"  id="username" name="username" class="form-control col-md-7 col-xs-12" placeholder="Username ..." required >
            @if ($errors->has('username'))
              <span class="help-block">{{ $errors->first('username') }}</span>
            @endif
        </div>
      </div>

      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">E-Mail <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text"  id="email" name="email" class="form-control col-md-7 col-xs-12" placeholder="E-mail ..." required >
            @if ($errors->has('email'))
              <span class="help-block">{{ $errors->first('email') }}</span>
            @endif
        </div>
      </div>

      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">Password <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="password"  id="password" name="password" class="form-control col-md-7 col-xs-12" placeholder="Password ..." required >
            @if ($errors->has('password'))
              <span class="help-block">{{ $errors->first('password') }}</span>
            @endif
        </div>
      </div>

      <div class="form-group{{ $errors->has('confirm-password') ? ' has-error' : '' }}">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">Konfirmasi Password <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="password"  id="confirm-password" name="confirm-password" class="form-control col-md-7 col-xs-12" placeholder="confirm-password ..." required >
            @if ($errors->has('confirm-password'))
              <span class="help-block">{{ $errors->first('confirm-password') }}</span>
            @endif
        </div>
      </div>

      <!-- <div class="col-12 col-sm-6">
        <div class="form-group">
          <label>Role</label>
          <div class="select2-purple">
              <select class="select2" name="roles[]" multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;">
                <option>Alabama</option>
                      <option>Alaska</option>
                      <option>California</option>
                      <option>Delaware</option>
                      <option>Tennessee</option>
                      <option>Texas</option>
                      <option>Washington</option>
                </select>
          </div>
        </div>
      </div> -->

      <div class="col-12 col-sm-6">
        <div class="form-group">
            <strong>Role:</strong>
            <div class="select2-purple">
              {!! Form::select('roles[]', $roles,[], array('class' => 'select2 form-control','multiple','select2-purple')) !!}
            </div>
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