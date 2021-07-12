@extends('adminlte::page')

@section('title', 'Jenis Biaya')

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
        Pembayaran Biaya SPP
        <small>Siswa Jenjang {{$jenjang->namaJenjang}} </small>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item active">Pembayaran SPP</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

@stop

@section('content')

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Pembayaran Biaya SPP</h3>

  </div>


  <div class="card-body">

    <div class="row">
      <div class="col-md-5">
        <div class="form-group">
          <label>Date range:</label>
        </div>
      </div>

    </div>

    <div class="row">
      <table>
        <tr>
          <td>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="far fa-calendar-alt"></i>
                </span>
              </div>
              <input type='text' readonly id='from_date' class="datepicker" placeholder='From date'>
            </div>
          </td>
          <td>
            <input type='text' readonly id='to_date' class="datepicker" placeholder='To date'>
          </td>
          <td>
            <input type='button' id="btn_search" class="btn btn-warning btn-sm" value="Search">
          </td>
        </tr>
      </table>
      {{ csrf_field() }}
    </div>
    <br />


    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th style="width: 10%">#</th>
          <th>Nama</th>
          <th>Tingkatan</th>
          <th>Jlh. SPP/Bln (Rp.)</th>
          <th>Tgl. Bayar</th>
          <!-- <th style="width: 20%">Aksi</th> -->
        </tr>
      </thead>
      <tbody>
        @php $i=1; $tot=0;@endphp
        @if (count($spp))

        @foreach($spp as $row)

        <tr>
          <td>{{$i}}. </td>
          <td>{{$row->siswa->nama}} </td>
          <td>{{$row->siswa->kelas->namaKelas}} </td>
          @php
          $totBayar = 0;
          //$selisih = ($row->totalBayar * $row->siswa->potspp['amount'])/100;
          $totBayar = $row->totalBayar ;
          $tot = $tot + $totBayar;
          @endphp
          <td> {{number_format($totBayar,0,',','.')}}


          </td>
          <td>{{$row->created_at}}
            @php


            @endphp

            <i>(pot.%) </i>
            @php


            @endphp

          </td>



          <!-- <td>
                              <a href="{{ route('payment.edit', $row->id) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> </a>
                              <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> </a>
                              <a href="#" class="btn btn-info btn-xs">Detail</a>
                              </td> -->
        </tr>
        @php $i++;

        // $tot=$tot+(integer)$totBayar;

        @endphp
        @endforeach
        @endif

      </tbody>
      <tfoot>
        <tr>
          <th style="width: 10%">#</th>
          <th>Nama</th>
          <th>Total (Rp.)</th>
          <th>{{number_format($tot,0,',','.')}}</th>
          <th>Tgl. Bayar</th>
          <!-- <th style="width: 20%">Aksi</th> -->
        </tr>

      </tfoot>

    </table>
  </div>
</div>


@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="{{asset('vendor/daterangepicker/daterangepicker.css')}}">
<link rel="stylesheet" href="{{asset('vendor/datepicker/bootstrap-datepicker.min.css')}}">
@stop

@section('js')
<script src="{{asset('vendor/daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('vendor/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('vendor/datepicker/bootstrap-datepicker.min.js')}}"></script>
<script>
  console.log('Hi!');

  function fetch_data(from_date = '', to_date = '') {
    $.ajax({
      url: "{{ route('dataRangeDate')}}",
      method: "POST",
      data: {
        from_date: from_date,
        to_date: to_date,
        _token: _token
      },
      dataType: "json",
      success: function(data) {
        var output = '';


      }
    })
  }

  $(function() {
    //Date range picker
    $('#reservation').daterangepicker();

    var _token = $('input[name="_token"]').val();

  })

  $(".datepicker").datepicker({
    "dateFormat": "yy-mm-dd",
    changeYear: true,
    autoclose: true
  });

  $('#reservation').on('change', function() {
    var isi = $(this).val();
    alert(isi);
  })

  $('#btn_search').click(function() {
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();

    if (from_date != '' && to_date != '') {
      fetch_data(from_date, to_date);
    } else {
      alert('Both Date is required');
    }

  })
</script>
@stop