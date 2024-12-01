@extends('layouts.app')

@section('title')
    Edit Transaction
@endsection

@section('content')

<div class="content-wrapper">
  <section class="content">
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">Form Edit Penjualan</h3>
      </div>
      <form method="post" action="{{ route('transaction.update', $transaction->id) }}">
        @csrf
        @method('PUT')
        <div class="box-body">
          <div class="row">
            <!-- Form untuk edit penjualan -->
            <div class="col-lg-3">
              <div class="form-group">
                <label>No. Invoice</label>
                <input type="text" class="form-control" name="invoice_no" required="required" value="{{ $transaction->invoice_no }}" readonly>
              </div>
            </div>

            <div class="col-lg-3">
              <div class="form-group">
                <label>Tanggal Invoice</label>
                <input type="date" class="form-control" name="tanggal" required="required" value="{{ $transaction->tanggal }}">
              </div>
            </div>

            <div class="col-lg-3">
              <div class="form-group">
                <label>Pelanggan</label>
                <input type="text" class="form-control" name="pelanggan" required="required" value="{{ $transaction->pelanggan }}">
              </div>
            </div>

            <div class="col-lg-3">
              <div class="form-group">
                <label for="invoice_alamat">Alamat</label>
                <input type="text" class="form-control" id="invoice_alamat" name="invoice_alamat" required="required" value="{{ $transaction->invoice_alamat }}">
              </div>
            </div>

            <div class="col-lg-3">
              <div class="form-group">
                <label for="invoice_tlp">Telepon</label>
                <input type="text" class="form-control" id="invoice_tlp" name="invoice_tlp" required="required" value="{{ $transaction->invoice_tlp }}">
              </div>
            </div>

            <div class="col-lg-3">
              <div class="form-group">
                <label for="invoice_tanggalkirim">Tanggal Pemasangan</label>
                <input type="date" class="form-control" id="invoice_tanggalkirim" name="invoice_tanggalkirim" required value="{{ $transaction->invoice_tanggalkirim }}">
              </div>
            </div>

            <div class="col-lg-3">
              <input type="hidden" name="kasir" value="{{ auth()->user()->id }}">
              <div class="form-group">
                <label>Kasir</label>
                <input type="text" class="form-control" id="invoice_kasir" name="invoice_kasir" required="required" value="{{ auth()->user()->name }}" readonly>
              </div>
            </div>
          </div>
          <hr>

          <div class="row">
            <div class="col-lg-3">
              <h3>Edit Pembelian</h3>

              <div class="row">
                <div class="form-group col-lg-7">
                  <label>Kode Produk</label>
                  <input type="hidden" class="form-control" id="tambahkan_id">
                  <input type="text" class="form-control" id="tambahkan_kode" placeholder="Masukkan Kode Produk ..">
                </div>

                <div class="col-lg-5">
                  <button style="margin-top: 27px" type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#cariProduk">
                    <i class="fa fa-search"></i> &nbsp Cari Produk
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="cariProduk" tabindex="-1" role="dialog" aria-labelledby="cariProdukLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          Pilih Pembelian produk
                        </div>
                        <div class="modal-body">
                          <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="table-datatable-produk">
                              <thead>
                                <tr>
                                  <th class="text-center">NO</th>
                                  <th>KODE</th>
                                  <th>PRODUK</th>
                                  <th class="text-center">SATUAN</th>
                                  <th class="text-center">STOK</th>
                                  <th class="text-center">HARGA JUAL</th>
                                  <th>KETERANGAN</th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                $no=1;
                                foreach ($product as $key => $d) {
                                  ?>
                                  <tr>
                                    <td width="1%" class="text-center"><?php echo $no++; ?></td>
                                    <td width="1%"><?php echo $d->code; ?></td>
                                    <td>
                                      <?php echo $d->name; ?>
                                      <br>
                                      <small class="text-muted"><?php echo $d->category; ?></small>
                                    </td>
                                    <td width="1%" class="text-center"><?php echo $d->satuan; ?></td>
                                    <td width="1%" class="text-center"><?php echo $d->stok; ?></td>
                                    <td width="20%" class="text-center"><?php echo "Rp.".number_format($d->harga_jual).",-"; ?></td>
                                    <td width="15%"><?php echo $d['keterangan']; ?></td>
                                    <td width="1%">              
                                      <?php 
                                      if($d['stok'] > 0){
                                        ?>          
                                        <input type="hidden" id="kode_<?php echo $d['id']; ?>" value="<?php echo $d['code']; ?>">
                                        <input type="hidden" id="nama_<?php echo $d['id']; ?>" value="<?php echo $d['name']; ?>">
                                        <input type="hidden" id="harga_<?php echo $d['id']; ?>" value="<?php echo $d['harga_jual']; ?>">
                                        <button type="button" class="btn btn-success btn-sm modal-pilih-produk" id="<?php echo $d['id']; ?>" data-dismiss="modal">Pilih</button>
                                        <?php 
                                      }
                                      ?>
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
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label>Produk</label>
                <input type="text" class="form-control" id="tambahkan_nama" disabled>
              </div>

              <div class="form-group">
                <label>Harga</label>
                <input type="text" class="form-control" id="tambahkan_harga" disabled>
              </div>

              <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control" id="tambahkan_jumlah" min="1">
              </div>

              <div class="form-group">
                <label>Total</label>
                <input type="text" class="form-control" id="tambahkan_total" disabled>
              </div>

              <div class="form-group">
                <label>Informasi</label>
                <input type="text" class="form-control" id="tambahkan_informasi">
              </div>

              <div class="form-group">
                <label>Size</label>
                <input type="text" class="form-control" id="tambahkan_size">
              </div>

              <div class="form-group">
                <span class="btn btn-sm btn-primary pull-right btn-block" id="tombol-tambahkan">TAMBAHKAN</span>
              </div>
            </div>

            <div class="col-lg-9">
              <h3>Daftar Pembelian</h3>

              <table class="table table-bordered table-striped table-hover" id="table-pembelian">
                <thead>
                  <tr>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Informasi</th>
                    <th>Size</th>
                    <th style="text-align: center;">Harga</th>
                    <th style="text-align: center;">Jumlah</th>
                    <th style="text-align: center;">Total</th>
                    <th style="text-align: center;" width="1%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $qtys = 0;
                        $prices = 0;
                    @endphp
                  @foreach($transaction->detail as $detail)
                  <tr id="tr_{{ $detail->id }}">
                    <td>
                      <input type="hidden" name="transaksi_produk[]" value="{{ $detail->product_id }}">
                      <input type="hidden" name="transaksi_harga[]" value="{{ $detail->price }}">
                      <input type="hidden" name="transaksi_total[]" value="{{ $detail->qty * $detail->price }}">
                      {{ $detail->products->code }}
                    </td>
                    <td>{{ $detail->products->name }}</td>
                    <td>{{ $detail->informasi }}<input type="hidden" name="informasi[]" value="{{ $detail->informasi }}"></td>
                    <td>{{ $detail->size }}<input type="hidden" name="size[]" value="{{ $detail->size }}"></td>
                    <td align="center">Rp.{{ number_format($detail->price) }},-</td>
                    <td align="center">
                      <input type="number" class="form-control qty-input" value="{{ $detail->qty }}" data-id="{{ $detail->id }}" min="1">
                    </td>
                    <td align="center" class="total-cell" data-id="{{ $detail->id }}">Rp.{{ number_format($detail->qty * $detail->price) }},-</td>
                    <td align="center">
                      <span class="btn btn-sm btn-danger tombol-hapus-penjualan" total="{{ $detail->qty * $detail->price }}" jumlah="{{ $detail->qty }}" harga="{{ $detail->price }}" id="{{ $detail->id }}"><i class="fa fa-close"></i> Batal</span>
                    </td>
                  </tr>
                  @php
                    $qtys +=$detail->qty;
                    $prices += $detail->price;
                @endphp
                  @endforeach
                </tbody>
                <tfoot>
                  <tr class="bg-info">
                    <td style="text-align: right;" colspan="4"><b>Total</b></td>
                    <td style="text-align: center;"><span class="pembelian_harga" id="{{ $prices }}">Rp.{{ number_format($prices) }},-</span></td>
                    <td style="text-align: center;"><span class="pembelian_jumlah" id="{{ $qtys }}">{{ $qtys }}</span></td>
                    <td style="text-align: center;"><span class="pembelian_total" id="{{ $transaction->total }}">Rp.{{ number_format($transaction->total) }},-</span></td>
                    <td style="text-align: center;"></td>
                  </tr>
                </tfoot>
              </table>

              <br>

              <div class="row">
                <div class="col-lg-6">
                  <table class="table table-bordered table-striped">
                    <tr>
                      <th width="50%">Sub Total Pembelian</th>
                      <td>
                        <input type="hidden" name="sub_total" class="sub_total_form" value="{{ $transaction->sub_total }}">
                        <span class="sub_total_pembelian" id="{{ $transaction->sub_total }}">Rp.{{ number_format($transaction->sub_total) }},-</span>
                      </td>
                    </tr>
                    <tr>
                      <th>Diskon</th>
                      <td>
                        <div class="row">
                          <div class="col-lg-10">
                            <input class="form-control total_diskon" type="number" min="0" max="100" id="{{ $transaction->diskon }}" name="diskon" value="{{ $transaction->diskon }}" required="required">
                          </div>
                          <div class="col-lg-2">%</div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th>Total Pembelian</th>
                      <td>
                        <input type="hidden" name="total" class="total_form" value="{{ $transaction->total }}">
                        <span class="total_pembelian" id="{{ $transaction->total }}">Rp.{{ number_format($transaction->total) }},-</span>
                      </td>
                    </tr>
                    <tr>
                      <th>Downpayment</th>
                      <td>
                        <span class="" id="0">Rp</span>
                        <input type="number" name="total_downpayment" class="form-control downpayment_form" value="{{ $transaction->total_downpayment }}">
                      </td>
                    </tr>
                    <tr>
                      <th>Sisa Total</th>
                      <td>
                        <span class="total_sisatotal" id="0">Rp</span>
                        <input type="number" name="total_sisatotal" class="form-control sisatotal_form" value="{{ $transaction->total_sisatotal }}">
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <hr>

          <br>
          <div class="form-group">
            <a href="{{ route('transaction.index') }}" class="btn btn-danger"><i class="fa fa-close"></i> Batalkan Perubahan</a>
            <button class="btn btn-success pull-right"><i class="fa fa-check"></i> Simpan Perubahan</button>
          </div>

          <br>
          <br>
        </div>
      </form>
    </div>
  </section>
</div>

@endsection

@push('script')
<script>
  $(document).ready(function() {
    function formatNumber(num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

    // pilih produk
    $(document).on("click", ".modal-pilih-produk", function() {
      var id = $(this).attr('id');
      var kode = $("#kode_" + id).val();
      var nama = $("#nama_" + id).val();
      var harga = $("#harga_" + id).val();

      $("#tambahkan_id").val(id);
      $("#tambahkan_kode").val(kode);
      $("#tambahkan_nama").val(nama);
      $("#tambahkan_harga").val(harga);
      $("#tambahkan_jumlah").val(1);
      $("#tambahkan_total").val(harga);
    });

    // ubah jumlah
    $(document).on("change keyup", "#tambahkan_jumlah", function() {
      var harga = $("#tambahkan_harga").val();
      var jumlah = $("#tambahkan_jumlah").val();
      var total = harga * jumlah;
      $("#tambahkan_total").val(total);
    });

    // ubah qty dan total di tabel
    $(document).on("change keyup", ".qty-input", function() {
      var row = $(this).closest('tr');
      var harga = parseFloat(row.find('input[name="transaksi_harga[]"]').val());
      var qty = parseInt($(this).val());
      var total = harga * qty;

      // Update total di kolom total
      row.find('.total-cell').text("Rp." + formatNumber(total) + ",-");
      
      // Update hidden total input
      row.find('input[name="transaksi_total[]"]').val(total);

      // Update total pembelian
      updateTotalPembelian();
    });

    // Update total pembelian
    function updateTotalPembelian() {
      var totalHarga = 0;
      var totalQty = 0;

      $('#table-pembelian tbody tr').each(function() {
        var qty = parseInt($(this).find('.qty-input').val());
        var total = parseFloat($(this).find('input[name="transaksi_total[]"]').val());
        totalHarga += total;
        totalQty += qty;
      });

      $(".pembelian_total").text("Rp." + formatNumber(totalHarga) + ",-");
      $(".pembelian_jumlah").text(totalQty);
      $(".sub_total_pembelian").text("Rp." + formatNumber(totalHarga) + ",-");
      $(".total_pembelian").text("Rp." + formatNumber(totalHarga) + ",-");
      $(".total_form").val(totalHarga);
    }

    // ubah jumlah
    $("body").on("keyup", "#tambahkan_kode", function() {
      var kode = $(this).val();
      var data = "kode=" + kode;
      $.ajax({
        type: "POST",
        url: "penjualan_cari_ajax.php",
        data: data,
        dataType: 'JSON',
        success: function(html) {
          $("#tambahkan_id").val(html[0].id);
          $("#tambahkan_nama").val(html[0].nama);
          $("#tambahkan_harga").val(html[0].harga);
          $("#tambahkan_jumlah").val(html[0].jumlah);
          $("#tambahkan_total").val(html[0].harga)
        }
      });
    });

    // tombol tambahkan produk
    $("body").on("click", "#tombol-tambahkan", function() {
      var id = $("#tambahkan_id").val();
      var kode = $("#tambahkan_kode").val();
      var nama = $("#tambahkan_nama").val();
      var harga = $("#tambahkan_harga").val();
      var jumlah = $("#tambahkan_jumlah").val();
      var total = $("#tambahkan_total").val();
      var informasi = $("#tambahkan_informasi").val();
      var size = $("#tambahkan_size").val();

      if (id.length == 0) {
        alert("Produk belum dipilih");
      } else if (kode.length == 0) {
        alert("Kode produk harus diisi");
      } else if (jumlah == 0) {
        alert("Jumlah harus lebih besar dari 0");
      } else {
        var table_pembelian = "<tr id='tr_" + id + "'>" +
          "<td> <input type='hidden' name='transaksi_produk[]' value='" + id + "'> <input type='hidden' name='transaksi_harga[]' value='" + harga + "'> <input type='hidden' name='transaksi_jumlah[]' value='" + jumlah + "'> <input type='hidden' name='transaksi_total[]' value='" + total + "'>" +
          kode +
          "</td>" +
          "<td>" + nama + "</td>" +
          "<td>" + informasi + "<input type='hidden' name='informasi[]' value='" + informasi + "'> </td>" +
          "<td>" + size + "<input type='hidden' name='size[]' value='" + size + "'> </td>" +
          "<td align='center'>Rp." + formatNumber(harga) + ",-</td>" +
          "<td align='center'><input type='number' class='form-control qty-input' value='" + jumlah + "' data-id='" + id + "' min='1'></td>" +
          "<td align='center'>Rp." + formatNumber(total) + ",-</td>" +
          "<td align='center'> <span class='btn btn-sm btn-danger tombol-hapus-penjualan' total='" + total + "' jumlah='" + jumlah + "' harga='" + harga + "' id='" + id + "'><i class='fa fa-close'></i> Batal</span></td>" +
          "</tr>";
        $("#table-pembelian tbody").append(table_pembelian);

        // Update total pembelian
        updateTotalPembelian();

        // kosongkan
        $("#tambahkan_id").val("");
        $("#tambahkan_kode").val("");
        $("#tambahkan_nama").val("");
        $("#tambahkan_harga").val("");
        $("#tambahkan_jumlah").val("");
        $("#tambahkan_total").val("")
      }
    });

    // tombol hapus penjualan
    $("body").on("click", ".tombol-hapus-penjualan", function() {
      var id = $(this).attr("id");
      var harga = $(this).attr("harga");
      var jumlah = $(this).attr("jumlah");
      var total = $(this).attr("total");

      // update total pembelian
      var pembelian_harga = $(".pembelian_harga").attr("id");
      var pembelian_jumlah = $(".pembelian_jumlah").attr("id");
      var pembelian_total = $(".pembelian_total").attr("id");

      // jumlahkan pembelian
      var kurangi_harga = eval(pembelian_harga) - eval(harga);
      var kurangi_jumlah = eval(pembelian_jumlah) - eval(jumlah);
      var kurangi_total = eval(pembelian_total) - eval(total);

      // isi di table penjualan
      $(".pembelian_harga").attr("id", kurangi_harga);
      $(".pembelian_jumlah").attr("id", kurangi_jumlah);
      $(".pembelian_total").attr("id", kurangi_total);

      // tulis di table penjualan
      $(".pembelian_harga").text("Rp." + formatNumber(kurangi_harga) + ",-");
      $(".pembelian_jumlah").text(formatNumber(kurangi_jumlah));
      $(".pembelian_total").text("Rp." + formatNumber(kurangi_total) + ",-");

      // total
      $(".total_pembelian").text("Rp." + formatNumber(kurangi_total) + ",-");
      $(".sub_total_pembelian").text("Rp." + formatNumber(kurangi_total) + ",-");
      $(".total_pembelian").attr("id", kurangi_total);
      $(".sub_total_pembelian").attr("id", kurangi_total);

      $(".total_form").val(kurangi_total);
      $(".sub_total_form").val(kurangi_total);

      $("#tr_" + id).remove();
    });

    // diskon
    $("body").on("keyup", ".total_diskon", function() {
      var diskon = $(this).val();

      if (diskon.length != 0 && diskon != "") {
        var sub_total = $(".sub_total_pembelian").attr("id");
        var total = $(".total_pembelian").attr("id");

        var hasil_diskon = sub_total * diskon / 100;
        var hasil2 = sub_total - hasil_diskon;
        $(".total_pembelian").text("Rp." + formatNumber(hasil2) + ",-");
        $(".total_form").val(hasil2);
      } else {
        var sub_total_pembelian = $(".sub_total_pembelian").attr("id");
        $(".total_pembelian").attr("id", sub_total_pembelian);
        $(".total_pembelian").text("Rp." + formatNumber(sub_total_pembelian) + ",-");
      }
    });

    // downpayment
    $("body").on("keyup", ".downpayment_form", function() {
      var downpayment = $(this).val();

      if (downpayment.length != 0 && downpayment != "") {
        var total = $(".total_pembelian").attr("id");
        var hasil2 = total - downpayment;
        $(".sisatotal_form").val(hasil2);
      }
    });
  });

  function cek() {
    var total = $(".total_pembelian").attr("id");
    if (total > 0) {
      return confirm('Apakah anda yakin ingin memproses transaksi?');
    } else {
      alert("Pembelian Masih Kosong");
      return false;
    }
  }
</script>
@endpush
