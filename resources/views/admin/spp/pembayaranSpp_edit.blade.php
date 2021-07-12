@extends('adminlte::page')

@section('title', 'Pembayaran SPP')

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
            <h1 class="m-0 text-dark">Pembayaran SPP  <a href="{{route('payment.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Back </a></h1>
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('payment.index')}}">Pembayaran Biaya</a></li>
              <li class="breadcrumb-item active">Detail Pembayaran SPP</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  
@stop

@section('content')
<div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Data Siswa</h3>

              
            </div>
            <form method="post" action="{{  route('grouppayment.update', $spp->id) }}" data-parsley-validate >
            {{ csrf_field() }}
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">NIS</label>
                <input type="text" id="nis" class="form-control" value="{{$spp->siswa->nis}} " readonly>
              </div>
              <div class="form-group">
                <label for="inputName">Nama</label>
                <input type="text" id="nama" class="form-control" value="{{$spp->siswa->nama}} " readonly>
              </div>
              <div class="">
                <label for="tingkat">Jenjang</label>
                <input type="text" class="form-control" id="jenjang" name='jenjang' value="{{$spp->siswa->kelas->tingkat->jenjang->namaJenjang}} " readonly >
                </div>
                        
                <div class="form-group{{ $errors->has('kelas') ? ' has-error' : '' }}">
                    <label for="kelas">Kelas</label>
                    <input type="text" class="form-control" id="kelas" name='kelas' value="{{$spp->siswa->kelas->namaKelas}} " readonly >
                    <input type="hidden" class="form-control" id="idSiswa" value="{{$spp->siswa->id}}" name="idSiswa" >
                    <input type="hidden" class="form-control" id="idKelas" value="{{$spp->siswa->kelas_id}}" name="idKelas" >
                </div>

              <div class="form-group">
                <label for="inputDescription">Catatan Bendahara</label>
                <textarea id="inputDescription" class="form-control" rows="4" name="catatan"></textarea>
              </div>
              
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Pembayaran</h3>

            </div>
            <div class="card-body">
            <form method="post" action="{{  route('grouppayment.update',$spp->id) }}" data-parsley-validate >
                    {{ csrf_field() }}
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="thnAjaran">Tahun Ajaran 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                                </div>
                                <input type="text" class="form-control float-right" id="thnAjaran" name="thnAjaran" readonly>
                            </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="ket">Besaran Potongan SPP (dlm persen(%)) 
                    </label>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="input-group">
                            
                            <input type="text" class="form-control" id="pot" name="pot" value="{{$datasiswa->b}}" readonly>
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="fas fa-percen-sign">%</i>
                                </span>
                            </div>
                            
                        </div>
                        
                        
                    </div>
                </div>
                @php  
                $totalPot = ($datasiswa->b/100)*$datasiswa->a;
                
                @endphp
                
                @php $total=0;$amount; @endphp
                        @foreach($setspp as $set)

                         @php  
                            
                            if ($set->jnsbiaya_id == 1)
                            {
                                $amount = $set->amount - $totalPot;
                            } else 
                            {
                                $amount = $set->amount;
                            }
                            $total= $total+$amount;
                         @endphp
                          <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                    
                            <label for="amount">{{$set->nama}} /bulan (Rp.)  </label>
                            <div class="input-group">
                                <span class="input-group-addon">Rp.</span>
                                <input type="text" id="amount" name="amount" class="form-control" value="{{number_format($amount,0,',','.')}}" readonly>
                            </div>
                        
                        </div>
                          @endforeach

                          <div class="form-group{{ $errors->has('total') ? ' has-error' : '' }}">
                    
                            <label for="amount">Total/bulan (Rp.) </label>
                            <div class="input-group">
                                <span class="input-group-addon">Rp.</span>
                                <input type="text" id="total" name="total" class="form-control" value="{{number_format($total,0,',','.')}}" readonly>
                            </div>
                        
                        </div>

                        <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                            <label for="tingkat">Bulan dan Tahun </label>
                            
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                                </div>
                                <input type="text" class="form-control float-right" id="bln"  name="bln" required>
                                @if ($errors->has('bln'))
                                                <span class="help-block">{{ $errors->first('bln') }}</span>
                                                @endif
                            </div>
                        
                        </div>

                        <div class="form-group{{ $errors->has('desk') ? ' has-error' : '' }}">
                    
                            <label for="tingkat">Keterangan </label>
                            <input type="text" class="form-control" id="desk" name='desk' required>
                            @if ($errors->has('desk'))
                                                <span class="help-block">{{ $errors->first('desk') }}</span>
                                                @endif
                            
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                            <input name="_method" type="hidden" value="PUT">
                            <button type="submit" id="tmb" class="btn btn-primary">Tambahkan</button>
                          </div>


            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          
          <!-- /.card -->
        </div>
        </form>
      </div>
      <div class="row">

        <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-12">
                  <h1 class="m-0 text-dark">Bukti Pembayaran SPP  </h1>
                  
                </div><!-- /.col -->
                
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        
        <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              Ini adalah tampilan cetak laporan. Klik tombol print untuk mencetak laporan.
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> Yayasan Pendidikan Tarbiyah Islamiyah - Hamparan Perak.
                    <small class="float-right">Tanggal: {{date('d-m-Y',strtotime($today))}}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-8 invoice-col">
                  
                  <address>
                  NIS {{$spp->siswa->nis}}<br>
                  <strong>{{$spp->siswa->nama}} </strong><br>
                  Kelas {{$spp->siswa->kelas->namaKelas}}<br>
                  Tingkatan {{$spp->siswa->kelas->tingkat->jenjang->namaJenjang}}<br>
                  </address>
                </div>
                <!-- /.col -->
                
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                <b>No. #{{$spp->id}}</b><br>
                <br>
                <b>Tahun Ajaran</b> {{$spp->thnAjaran}}<br>
                <b>Tgl. Bayar</b> {{date('d-m-Y  h:i:s A',strtotime($spp->created_at))}}<br>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                    <th>Jenis Pembayaran</th>
                    <th>Keterangan</th>
                    <th>Jumlah (Rp.)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $totalBiaya=0;$bintang=""; @endphp
                    @if (count($detailBayar))
                    @php $i=1;  @endphp
                    @foreach($detailBayar as $row)
                    <tr>
                      
                      <td>{{$row->namaBiaya}}</td>
                      <td>{{$row->desk}}</td>
                      @php  
                        $totalB=0;
                            if ($row->jnsId == 1)
                            {
                                $amount = $row->amount - $totalPot;
                                $bintang = "Pot. SPP 10%.";
                            } else 
                            {
                                $amount = $row->amount;
                            }
                            $totalB= $totalB+$amount;
                         @endphp
                      @php
                        $jlh = 0;
                        //$selisih = ($pot )/100;
                        $jlh = $row->amount;
                      @endphp
                      <td>{{number_format($row->amount,0,',','.')}} * </td>
                      <td>
                      <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i> Delete</a>
                      </td>
                    </tr>
                    @php $i++; $totalBiaya=$totalBiaya + $row->amount;  @endphp
                    @endforeach
                    @endif
                    
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                  Catatan Bendahara : {{$spp->desk}}
                            <br>* {{$bintang}}
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Pembayaran per {{date('d-m-Y  h:i:s A',strtotime($spp->created_at))}}</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Total:</th>
                        <td>Rp. {{number_format($totalBiaya,0,',','.')}},-</td>
                      </tr>
                      
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit Pembayaran
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->

      </div>

  



@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="{{asset('vendor/datepicker/bootstrap-datepicker.min.css')}}">
@stop

@section('js')
<script src="{{asset('vendor/datepicker/bootstrap-datepicker.min.js')}}"></script>
@section('plugins.DateRangePicker', true)

<!-- bootstrap datepicker -->
<script>
    //console.log('Hi!')
    function ta(){
            var d = new Date();
            var ta;
            if(d.getMonth()>5){
                ta = (d.getFullYear())+"/"+(d.getFullYear()+1); 
            }
            else {
                ta = (d.getFullYear()-1)+"/"+(d.getFullYear()); 
            }
            return ta;
        }
    $(function () {

      $('#tmb').hide();

        var x = ta();
        $("#thnAjaran").val(x);

        // $('#thnAjaran').daterangepicker({
            
        //     locale: {
        //         format: 'YYYY'
        //     }
        // })

        $('#bln ').datepicker({ 
              autoclose: true,
              format: 'mm/yyyy',
                        viewMode: "months",
                        minViewMode: "months",
               
            })
            $("#bln").val(d.getMonth()+1+"/"+d.getFullYear());


        })

        $('#bln').on('change',function(){
          var isi = $(this).val();
          var siswa = $('#idSiswa').val();
          $.ajax({
                        type:'GET',
                        url: "{{url('cekSpp')}}?id="+isi+"&siswa="+siswa,
                        success:function(res){
                            //alert(res);
                            if(res.month){
                                $('#tmb').hide();
                                alert('Bulan ini sudah dibayar');
                        }
                        else {
                          $('#tmb').show();
                          
                        }

                    }
                });
        });
    
</script>
@stop