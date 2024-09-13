@extends('layouts.app')

@section('title')
Dashboard
@endsection

@section('content')
<div class="content-wrapper">
  @php
    use App\Models\Product;
    use App\Models\Category;
    use App\Models\Transaction;
    use Carbon\Carbon;

    $tanggal = Carbon::now()->format('Y-m-d');
    $bulan = Carbon::now()->format('m');
    $tahun = Carbon::now()->format('Y');

    // Data calculations
    $penjualanHariIni = Transaction::whereDate('tanggal', $tanggal)->sum('total') ?? 0;
    $penjualanBulanIni = Transaction::whereMonth('tanggal', $bulan)->sum('total') ?? 0;
    $penjualanTahunIni = Transaction::whereYear('tanggal', $tahun)->sum('total') ?? 0;
    $totalPenjualan = Transaction::sum('total') ?? 0;

    $labaHariIni = Transaction::whereDate('tanggal', $tanggal)->sum('total_profit') ?? 0;
    $labaBulanIni = Transaction::whereMonth('tanggal', $bulan)->sum('total_profit') ?? 0;
    $labaTahunIni = Transaction::whereYear('tanggal', $tahun)->sum('total_profit') ?? 0;
    $totalLaba = Transaction::sum('total_profit') ?? 0;

    $jumlahProduk = Product::count();
    $jumlahKategori = Category::count();
    $jumlahInvoice = Transaction::count();

    // Data for charts
    $penjualanPerHari = Transaction::selectRaw('DATE(tanggal) as date, SUM(total) as total')
        ->whereDate('tanggal', '>=', Carbon::now()->startOfMonth())
        ->groupBy('date')
        ->orderBy('date')
        ->pluck('total', 'date')
        ->toArray();

    $labaPerHari = Transaction::selectRaw('DATE(tanggal) as date, SUM(total_profit) as total_profit')
        ->whereDate('tanggal', '>=', Carbon::now()->startOfMonth())
        ->groupBy('date')
        ->orderBy('date')
        ->pluck('total_profit', 'date')
        ->toArray();

    $tanggalLabels = array_keys($penjualanPerHari);
    $tanggalLabels = array_map(function ($date) {
        return Carbon::parse($date)->format('d M');
    }, $tanggalLabels);
  @endphp

  <section class="content">
    <div class="row">
      <!-- Penjualan Hari Ini -->
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
          <div class="inner">
            <h4 style="font-weight: bolder">{{ "Rp. " . number_format($penjualanHariIni) . " ,- " }}</h4>
            <p>Penjualan Hari Ini</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
        </div>
      </div>

      <!-- Penjualan Bulan Ini -->
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-blue">
          <div class="inner">
            <h4 style="font-weight: bolder">{{ "Rp. " . number_format($penjualanBulanIni) . " ,- " }}</h4>
            <p>Penjualan Bulan Ini</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
        </div>
      </div>

      <!-- Penjualan Tahun Ini -->
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h4 style="font-weight: bolder">{{ "Rp. " . number_format($penjualanTahunIni) . " ,- " }}</h4>
            <p>Penjualan Tahun Ini</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
        </div>
      </div>

      <!-- Total Seluruh Penjualan -->
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-black">
          <div class="inner">
            <h4 style="font-weight: bolder">{{ "Rp. " . number_format($totalPenjualan) . " ,- " }}</h4>
            <p>Total Seluruh Penjualan</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
        </div>
      </div>

      <!-- Laba Hari Ini -->
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
          <div class="inner">
            <h4 style="font-weight: bolder">{{ "Rp. " . number_format($labaHariIni) . " ,- " }}</h4>
            <p>Laba Hari Ini</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
        </div>
      </div>

      <!-- Laba Bulan Ini -->
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-blue">
          <div class="inner">
            <h4 style="font-weight: bolder">{{ "Rp. " . number_format($labaBulanIni) . " ,- " }}</h4>
            <p>Laba Bulan Ini</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
        </div>
      </div>

      <!-- Laba Tahun Ini -->
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h4 style="font-weight: bolder">{{ "Rp. " . number_format($labaTahunIni) . " ,- " }}</h4>
            <p>Laba Tahun Ini</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
        </div>
      </div>

      <!-- Total Seluruh Laba -->
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-black">
          <div class="inner">
            <h4 style="font-weight: bolder">{{ "Rp. " . number_format($totalLaba) . " ,- " }}</h4>
            <p>Total Seluruh Laba</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
        </div>
      </div>

      <!-- Jumlah Produk -->
      <div class="col-lg-2 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <h4 style="font-weight: bolder">{{ $jumlahProduk }}</h4>
            <p>Jumlah Produk</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
        </div>
      </div>

      <!-- Jumlah Kategori Produk -->
      <div class="col-lg-2 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <h4 style="font-weight: bolder">{{ $jumlahKategori }}</h4>
            <p>Jumlah Kategori Produk</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
        </div>
      </div>

      <!-- Jumlah Invoice -->
      <div class="col-lg-2 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <h4 style="font-weight: bolder">{{ $jumlahInvoice }}</h4>
            <p>Jumlah Invoice</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- /.row -->
    <div class="row">
      <section class="col-lg-6">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs pull-right">
            <li class="active"><a href="#tab1" data-toggle="tab">Perhari</a></li>
            <li class="pull-left header">Grafik Penjualan Perhari</li>
          </ul>
          <div class="tab-content" style="padding: 20px">
            <div class="chart tab-pane active" id="tab1">
             
              <div class="grafik">
                <canvas id="myChart" height="182"></canvas>
              </div>
              
              <div id="script">
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="col-lg-6">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs pull-right">
            <li class="active"><a href="#tab1" data-toggle="tab">Perbulan</a></li>
            <li class="pull-left header">Grafik Penjualan Perbulan</li>
          </ul>
          <div class="tab-content" style="padding: 20px">
            <div class="chart tab-pane active" id="tab1">
              <div class="grafiks">
                <canvas id="myCharts" height="182"></canvas>
              </div>
              
              <div id="scripts">
              </div>
            </div>
            <div class="chart tab-pane" id="tab2" style="position: relative; height: 300px;"></div>
          </div>
        </div>
      </section>
    </div>
  </section>
</div>

@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
         $(document).ready(function(){
        csrfToken = "{{ csrf_token() }}";
        getDataWeek();
        getDataYear();
      });


      function getDataWeek()
        {
            var string = {
                    type : "grafik",
                    _token: csrfToken
            };
            $.ajax({
                url   : "{{ route('home') }}",
                method : 'GET',
                data : string,
                beforeSend:function(){
                    $('#myChart').remove();
                    $('.grafik').append('<canvas id="myChart"><canvas>');
                },
                success:function(config){
        
                    $("#script").html(config);
                }
            });
        
        }

        
      function getDataYear()
        {
            var string = {
                    type : "grafiks",
                    _token: csrfToken
            };
            $.ajax({
                url   : "{{ route('homes') }}",
                method : 'GET',
                data : string,
                beforeSend:function(){
                    $('#myCharts').remove();
                    $('.grafiks').append('<canvas id="myCharts"><canvas>');
                },
                success:function(config){
        
                    $("#scripts").html(config);
                }
            });
        
        }
    </script>
@endpush