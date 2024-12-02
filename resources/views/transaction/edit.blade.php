@extends('layouts.app')

@section('title', 'Edit Transaction')

@section('content')

<section class="content">
  <div class="box box-info">
    <div class="box-header">
      <h3 class="box-title">Form Tambah Penjualan</h3>
    </div>

<form method="POST" action="{{ route('transaction.update', $d['id']) }}">
  @csrf
  @method('PUT')
  <div class="modal-body">
    <div class="row">
      <div class="col-lg-12">
        <label>Kasir yang melayani</label>
        <p>{{ $d['kasir'] }}</p>
      </div>
      <div class="col-lg-4">
        <label>No. Invoice</label>
        <p>{{ $d['invoice_no'] }}</p>
      </div>
      <div class="col-lg-4">
        <label>Tanggal Invoice</label>
        <p>{{ date('d-m-Y', strtotime($d['tanggal'])) }}</p>
      </div>
      <div class="col-lg-4">
        <label>Pelanggan</label>
        <p>{{ $d['nama_pelanggan'] }}</p>
      </div>
      <div class="col-lg-4">
        <label>Alamat</label>
        <p>{{ $d['alamat'] }}</p>
      </div>
      <div class="col-lg-4">
        <label>Tlp</label>
        <p>{{ $d['telp'] }}</p>
      </div>
      <div class="col-lg-4">
        <label>Tanggal Pemasangan</label>
        <p>{{ date('d-m-Y', strtotime($d['tanggal_kirim'])) }}</p>
      </div>
    </div>
    <hr>
    <b>Daftar Pembelian</b>
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          @foreach($d->detail as $ky => $pp)
            <tr>
              <td>{{ $pp['product'] }}</td>
              <td>Rp.{{ number_format($pp['price']) }}</td>
              <td>
                <input type="hidden" name="detail[{{ $ky }}][id]" value="{{ $pp['id'] }}">
                <input type="hidden" name="detail[{{ $ky }}][product_id]" value="{{ $pp['product_id'] }}">
                <input type="number" name="detail[{{ $ky }}][qty]" id="qty-{{ $d['id'] }}-{{ $ky }}" value="{{ $pp['qty'] }}" class="form-control qty-input-{{ $d['id'] }}" data-price="{{ $pp['price'] }}" min="1">
              </td>
              <td>
                <span id="item-total-{{ $d['id'] }}-{{ $ky }}">Rp.{{ number_format($pp['qty'] * $pp['price']) }}</span>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <table class="table">
          <tr>
            <th>Sub Total</th>
            <td>
              <span id="edit-sub-total-{{ $d['id'] }}">Rp.{{ number_format($d['sub_total']) }}</span>
              <input type="hidden" name="sub_total" value="{{ $d['sub_total'] }}" class="sub-total-{{ $d['id'] }}">
            </td>
          </tr>
          <tr>
            <th>Total Paid</th>
            <td>
              <input type="number" name="paid" id="paid-{{ $d['id'] }}" value="{{ $d['paid'] }}" class="form-control paid-input-{{ $d['id'] }}" min="0">
            </td>
          </tr>
          <tr>
            <th>Unpaid</th>
            <td>
              <input type="number" name="unpaid" id="unpaid-{{ $d['id'] }}" value="{{ $d['unpaid'] }}" class="form-control unpaid-input-{{ $d['id'] }}" readonly>
            </td>
          </tr>
          <tr>
            <th>Diskon</th>
            <td>
              <?php echo $d['diskon'] ?>%
              <input type="hidden" name="diskon" value="{{ $d['diskon'] }}" class="diskons-{{ $d['id'] }}">
            </td>
          </tr>
          <tr>
            <th>Total</th>
            <td>
              <span id="edit-total-{{ $d['id'] }}">Rp.{{ number_format($d['total']) }}</span>
              <input type="hidden" name="total" value="{{ $d['total'] }}" class="totals-{{ $d['id'] }}">
            </td>
          </tr>
        </table>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </div>
</form>

    </div>
  </section>
@push('script')
<script>
  $(document).on('input', '.qty-input-{{ $d['id'] }}, .paid-input-{{ $d['id'] }}', function() {
    let subTotal = 0;

    $('.qty-input-{{ $d['id'] }}').each(function() {
      let qty = $(this).val() || 0;
      let price = $(this).data('price');
      subTotal += price * qty;

      let rowId = $(this).attr('id').split('-').pop();
      $('#item-total-{{ $d['id'] }}-' + rowId).text('Rp.' + (price * qty).toLocaleString());
    });

    $('#edit-sub-total-{{ $d['id'] }}').text('Rp.' + subTotal.toLocaleString());
    $('.sub-total-{{ $d['id'] }}').val(subTotal);

    let paid = parseFloat($('#paid-{{ $d['id'] }}').val()) || 0;
    let unpaid = subTotal - paid;
    let diskon = $('.diskons-{{ $d['id'] }}').val();
    let subTotaldiskon = subTotal * diskon/100;
    let totals = subTotal -subTotaldiskon;

    $('#unpaid-{{ $d['id'] }}').val(unpaid);
    $('.totals-{{ $d['id'] }}').val(totals);
    $('#edit-total-{{ $d['id'] }}').text('Rp.' + totals.toLocaleString());
  });
</script>
@endpush
@endsection
