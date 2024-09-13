@extends('layouts.app')

@section('title')
LAPORAN
@endsection


@section('content')
    

<div class="content-wrapper">

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">Filter Laporan Penjualan</h3>
          </div>
          <div class="box-body">
            <form method="get" action="">
              <div class="row">
                <div class="col-md-2">

                  <div class="form-group">
                    <label>Mulai Tanggal</label>
                    <input autocomplete="off" type="date" value="<?php if(isset($_GET['tanggal_dari'])){echo $_GET['tanggal_dari'];}else{echo "";} ?>" name="tanggal_dari" class="form-control " placeholder="Mulai Tanggal" required="required">
                  </div>

                </div>

                <div class="col-md-2">

                  <div class="form-group">
                    <label>Sampai Tanggal</label>
                    <input autocomplete="off" type="date" value="<?php if(isset($_GET['tanggal_sampai'])){echo $_GET['tanggal_sampai'];}else{echo "";} ?>" name="tanggal_sampai" class="form-control " placeholder="Sampai Tanggal" required="required">
                  </div>

                </div>

                <div class="col-md-1">

                  <div class="form-group">
                    <input style="margin-top: 26px" type="submit" value="TAMPILKAN" class="btn btn-sm btn-primary btn-block">
                  </div>

                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">Data Penjualan</h3>
          </div>
          <div class="box-body">

            <?php 
            if(isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari'])){
              $tgl_dari = $_GET['tanggal_dari'];
              $tgl_sampai = $_GET['tanggal_sampai'];
              ?>

              <div class="row">
                <div class="col-lg-6">
                  <table class="table table-bordered">
                    <tr>
                      <th width="30%">DARI TANGGAL</th>
                      <th width="1%">:</th>
                      <td><?php echo $tgl_dari; ?></td>
                    </tr>
                    <tr>
                      <th>SAMPAI TANGGAL</th>
                      <th>:</th>
                      <td><?php echo $tgl_sampai; ?></td>
                    </tr>
                  </table>
                  
                </div>
              </div>

              <div class="table-responsive">

                <table class="table table-bordered table-striped" id="table-datatable">
                  <thead>
                    <tr>
                      <th width="1%">NO</th>
                      <th width="10%" class="text-center">NO.INVOICE</th>
                      <th class="text-center">TANGGAL</th>
                      <th class="text-center">PELANGGAN</th>
                      <th class="text-center">KASIR</th>
                      <th class="text-center">SUB TOTAL</th>
                      <th class="text-center">DISKON (%)</th>
                      <th class="text-center">TOTAL BAYAR</th>
                      <th class="text-center">MODAL</th>
                      <th class="text-center">LABA</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no=1;
                    $x_total_sub_total = 0;
                    $x_total_total = 0;
                    $x_total_modal = 0;
                    $x_total_laba = 0;
                  foreach($data as $d){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center"><?php echo $d['invoice_no']; ?></td>
                      <td class="text-center"><?php echo date('d-m-Y', strtotime($d['tanggal_kirim'])); ?></td>
                      <td class="text-center"><?php echo $d['nama_pelanggan']; ?></td>
                      <td class="text-center"><?php echo $d['kasir']; ?></td>
                      <td class="text-center"><?php echo "Rp.".number_format($d['sub_total']).",-"; ?></td>
                      <td class="text-center"><?php echo $d['diskon']; ?>%</td>
                      <td class="text-center"><?php echo "Rp.".number_format($d['total']).",-"; ?></td>
                      <td class="text-center"><?php echo number_format($d['sub_total'] - $d['total_profit']); ?></td>
                      <td class="text-center"><?php echo "Rp.".number_format($d['total_profit']).",-"; ?></td>
                      <td>   
                      </tr>
                      <?php 
                       $x_total_sub_total += $d['sub_total'];
                      $x_total_total += $d['total'];
                      $x_total_modal += $d['sub_total'] - $d['total_profit'];
                      $x_total_laba += $d['total_profit'];
                    }
                    ?>
                  </tbody>
                  <tfoot>
                    <tr class="bg-info">
                      <td colspan="5" class="text-right"><b>TOTAL</b></td>
                      <td class="text-center"><?php echo "Rp.".number_format($x_total_sub_total).",-"; ?></td>
                      <td class="text-center"></td>
                      <td class="text-center"><?php echo "Rp.".number_format($x_total_total).",-"; ?></td>
                      <td class="text-center"><?php echo "Rp.".number_format($x_total_modal).",-"; ?></td>
                      <td class="text-center"><?php echo "Rp.".number_format($x_total_laba).",-"; ?></td>
                    </tr>
                  </tfoot>
                </table>

              </div>

              <?php 
            }else{
              ?>

              <div class="alert alert-info text-center">
                Silahkan Filter Laporan Terlebih Dulu.
              </div>

              <?php
            }
            ?>

          </div>
        </div>
      </section>
    </div>
  </section>

</div>
@endsection