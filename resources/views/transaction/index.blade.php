@extends('layouts.app')

@section('title')
    Transaction
@endsection


@section('content')
    
<section class="content">

    <a href="{{route('transaction.create')}}" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> &nbsp; INPUT PENJUALAN</a>

    <br>
    <br>

    <div class="row">
      <section class="col-lg-12">
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Transaksi Penjualan Yang Saya Layani</h3>
          </div>
          <div class="box-body">


            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th width="10%" class="text-center">NOMOR</th>
                    <th class="text-center">TANGGAL</th>
                    <th class="text-center">TANGGAL PEMASANGAN</th>
                    <th class="text-center">PELANGGAN</th>
					<th class="text-center">ALAMAT</th>
					<th class="text-center">TLP</th>
                    <th class="text-center">KASIR</th>
                    <th class="text-center">SUB TOTAL</th>
                    <th class="text-center">DISKON (%)</th>
                    <th class="text-center">TOTAL BAYAR</th>
					<th class="text-center">DP</th>
					<th class="text-center">SISA TOTAL</th>
                    <th width="7%" class="text-center">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no=1;
                  foreach($data as $d){
                    ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td class="text-center"><?php echo $d['invoice_no']; ?></td>
                      <td class="text-center"><?php echo date('d-m-Y', strtotime($d['tanggal'])); ?></td>
                      <td class="text-center"><?php echo date('d-m-Y', strtotime($d['tanggal_kirim'])); ?></td>
                      <td class="text-center"><?php echo $d['nama_pelanggan']; ?></td>
					  <td class="text-center"><?php echo $d['alamat']; ?></td>
					  <td class="text-center"><?php echo $d['telp']; ?></td>
                      <td class="text-center"><?php echo $d['kasir']; ?></td>
                      <td class="text-center"><?php echo "Rp.".number_format($d['sub_total']).",-"; ?></td>
                      <td class="text-center"><?php echo $d['diskon']; ?>%</td>
                      <td class="text-center"><?php echo "Rp.".number_format($d['total']).",-"; ?></td>
					  <td class="text-center"><?php echo number_format($d['paid']); ?></td>
					  <td class="text-center"><?php echo "Rp.".number_format($d['unpaid']).",-"; ?></td>
                      <td>    

                        <div class="btn-group">


                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detail_pembelian_<?php echo $d['id'] ?>">
                            <i class="fa fa-search"></i>
                          </button>

                          <a target="_blank" href="{{route('transaction.show',$d)}}" class="btn btn-success btn-sm"><i class="fa fa-file"></i></a>

                        </div>

                        <div class="modal fade" id="detail_pembelian_<?php echo $d['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="exampleModalLabel">Detail Penjualan</h4>
                              </div>
                              <div class="modal-body">

                                <div class="row">

                                  <div class="col-lg-12">
                                   <label>Kasir yang melayani</label>
                                   <br>
                                   <?php echo $d['kasir']; ?>
                                 </div>

                                 <br>
                                 <br>
                                 <br>

                                 <div class="col-lg-4">

                                  <div class="form-group">
                                    <label>No. Invoice</label>
                                    <br>
                                    <?php echo $d['invoice_no']; ?>
                                  </div>

                                </div>
                                <div class="col-lg-4">

                                  <div class="form-group">
                                    <label>Tanggal Invoice</label>
                                    <br>
                                    <?php echo date('d-m-Y', strtotime($d['tanggal'])); ?>
                                  </div>

                                </div>
                                <div class="col-lg-4">

                                  <div class="form-group">
                                    <label>Pelanggan</label>
                                    <br>
                                    <?php echo $d['nama_pelanggan']; ?>
                                  </div>

                                </div>
									
								<div class="col-lg-4">

                                  <div class="form-group">
                                    <label>Alamat</label>
                                    <br>
                                    <?php echo $d['alamat']; ?>
                                  </div>

                                </div>
									
								<div class="col-lg-4">

                                  <div class="form-group">
                                    <label>Tlp</label>
                                    <br>
                                    <?php echo $d['telp']; ?>
                                  </div>

                                </div>
									
							    <div class="col-lg-4">

                                  <div class="form-group">
                                    <label>Tanggal Pemasangan</label>
                                    <br>
                                    <?php echo date('d-m-Y', strtotime($d['tanggal_kirim'])); ?>
                                  </div>

                                </div>

                              </div>

                              <hr>  

                              <b>Daftar Pembelian</b>

                              <table class="table table-bordered table-striped table-hover" id="table-pembelian">
                                <thead>
                                  <tr>
                                    <th>Nama Produk</th>
                                    <th width="1%" style="text-align: center;">Harga</th>
                                    <th width="1%" style="text-align: center;">Jumlah</th>
                                    <th width="1%" style="text-align: center;">Total</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                  $id_invoice = $d['id'];
                                  foreach($d->detail as $pp){
                                    ?>
                                    <tr>
                                      <td>
                                        <?php echo $pp['product']; ?>
                                       
                                      </td>
                                      <td style="text-align: center;"><?php echo "Rp.".number_format($pp['price']).",-"; ?></td>  
                                      <td style="text-align: center;"><?php echo $pp['qty']; ?></td>
                                      <td style="text-align: center;"><?php echo "Rp.".number_format($pp['profit']).",-"; ?></td>  
                                    </tr>
                                    <?php 
                                  }
                                  ?>
                                </tbody>
                              </table>


                              <div class="row">
                                <div class="col-lg-6">
                                  <table class="table table-bordered table-striped">
                                    <tr>
                                      <th width="50%">Sub Total</th>
                                      <td>
                                        <span class="sub_total_pembelian"><?php echo "Rp.".number_format($d['sub_total']).",-"; ?></span>
                                      </td>
                                    </tr>
                                    <tr>
                                      <th>Diskon</th>
                                      <td>
                                        <?php echo $d['diskon'] ?>%
                                      </td>
                                    </tr>
                                    <tr>
                                      <th>Total</th>
                                      <td>
                                        <span class="total_pembelian"><?php echo "Rp.".number_format($d['total']).",-"; ?></span>
                                      </td>
                                    </tr>
									<tr>
                                      <th>Downpayment</th>
                                      <td>
                                        <?php echo number_format($d['paid']) ?>
                                      </td>
                                    </tr>
									<tr>
                                      <th>Sisa Total</th>
                                      <td>
                                        <span class="total_pembelian"><?php echo "Rp.".number_format($d['unpaid']).",-"; ?></span>
                                      </td>
                                    </tr>
                                  </table>
                                </div>
                              </div>



                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                          </div>
                        </div>
                      </div>


                    </td>
                  </tr>
                  <?php 
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </section>
  </div>
</section>
@endsection