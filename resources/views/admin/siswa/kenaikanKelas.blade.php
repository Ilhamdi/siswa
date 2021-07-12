@extends('adminlte::page')

@section('title', 'Kenaikan Kelas')

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
            <h1 class="m-0 text-dark">Kenaikan Kelas <a href="{{url('datasiswa')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h1>
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/siswa') }}">Data siswa</a></li>
              <li class="breadcrumb-item active">Edit siswa</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  
@stop

@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Kenaikan Kelas</h3>
      
  </div>


<div class="card-body">
    <form method="post" action="{{ route('kenaikan') }} " data-parsley-validate >
    {{ csrf_field() }}
        <div class="col-sm-6 col-md-6 ">
            <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                <label for="tingkat"><i>Dari Kelas </i></label>
                <select class="form-control select2" id="from" name="from" style="width: 100%;" required>
                    <option >Ketikkan Nama Kelas</option>
                    @if(count($datasiswa))
                        @foreach($kelas as $row)
                    <option value="{{$row->id}}">{{$row->namaKelas}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="col-sm-6 col-md-6 ">
            <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                <label for="tingkat"><i>Menjadi Kelas </i></label>
                <select class="form-control select2" id="to" name="to" style="width: 100%;" required>
                    <option >Ketikkan Nama Kelas</option>
                    @if(count($datasiswa))
                        @foreach($kelas as $row)
                    <option value="{{$row->id}}">{{$row->namaKelas}}</option>
                        @endforeach
                    @endif
                </select>
                              
            </div>
        </div>


    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
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

    $(document).ready(function() {

            


$('#jenjang').on('change',function(){
  
    var jenjangID = $(this).val();
    if(jenjangID){
        $.ajax({
            type:'GET',
            url:"{{url('getTingkat')}}?id="+jenjangID,
            success:function(res){
                if(res){
                    $("#tingkat").empty();
                    $("#tingkat").append('<option value="">Pilih tingkat</option>');
                    $.each(res,function(key,value){
                        $("#tingkat").append('<option value="'+key+'">'+value+'</option>');
                    });
               
                }else{
                   $("#tingkat").empty();
                }
            }

        });
    }else{
        $("#tingkat").empty();
    } 

});

$('#tingkat').on('change',function(){
  
  var tingkatID = $(this).val();
  if(tingkatID){
      $.ajax({
          type:'GET',
          url:"{{url('getKelas')}}?id="+tingkatID,
          success:function(res){
              if(res){
                  $("#kelas").empty();
                  $("#kelas").append('<option value="">Pilih kelas</option>');
                  $.each(res,function(key,value){
                      $("#kelas").append('<option value="'+key+'">'+value+'</option>');
                  });
             
              }else{
                 $("#kelas").empty();
              }
          }

      });
  }else{
      $("#kelas").empty();
  } 

});


$('#nis').on('change',function(){
    //alert($(this).val());
    var nis = $(this).val();
    if(nis){
        $.ajax({
            type:'GET',
            url:"{{url('cekNis')}}?id="+nis,
            success: function(res){
                if(res.length > 0){
                    alert("NIS sudah Ada");
                     $("#nis").val('');
                     $("#nis").empty();

                }
            }

        });
    }
})



});
</script>
@stop