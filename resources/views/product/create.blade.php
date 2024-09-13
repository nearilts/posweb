@extends('layouts.app')

@section('title')
    Product
@endsection



@section('content')


<div class="content-wrapper">


  <section class="content">
    <div class="row">
      <section class="col-lg-8 col-lg-offset-2">       
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Tambah Produk</h3>
            <a href="{{route('product.index')}}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a> 
          </div>

          <div class="box-body">


          <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">
              <div class="form-group col-lg-4">
                <label>Kode Produk</label>
                <?php 
                // mencari kode barang dengan nilai paling besar
                $hasil = \App\Models\Product::latest()->first();
                $kodeProduk = $hasil ? $hasil->code : 'PROD000';
               
                $noUrut = substr($kodeProduk, 4, 3);
                // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
                $noUrut++;

                $char = "PROD";
                $kodeProduk = $char . sprintf("%03s", $noUrut);
                ?>
                <input type="text" class="form-control" name="code" required="required" placeholder="Masukkan Kode Produk .. (Wajib)" value="<?php echo $kodeProduk; ?>" readonly>
              </div>
            </div>

            <div class="form-group">
              <label>Nama Produk</label>
              <input type="text" value="{{old('name')}}" class="form-control" name="name" required="required" placeholder="Masukkan Nama Produk .. (Wajib)">
            </div>

            <div class="row">
              <div class="form-group col-lg-4">
                <label>Satuan</label>
                <input type="text" class="form-control" name="satuan" value="{{old('satuan')}}" required="required" placeholder="Contoh: Kg, Klg, Pack, dll .. (Wajib)">
              </div>

              <div class="form-group col-lg-4">
                <label>Kategori</label>
                <select name="cateogry_id" class="form-control" required="required">
                  <option value="">- Pilih -</option>
                @foreach ($category as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                    
                @endforeach
                </select>
              </div>

              <div class="form-group col-lg-4">
                <label>Stok</label>
                <input type="number" class="form-control" name="stok" value="{{old('stok')}}" required="required" placeholder="Masukkan Jumlah Stok .. (Wajib)">
              </div>

            </div>



            <div class="row">
              <div class="form-group col-lg-6">
                <label>Harga Modal</label>
                <input type="number" class="form-control" name="harga_modal" value="{{old('harga_modal')}}" required="required" placeholder="Harga Modal .. (Wajib)">
              </div>

              <div class="form-group col-lg-6">
                <label>Harga Jual</label>
                <input type="number" class="form-control" name="harga_jual" value="{{old('harga_jual')}}" required="required" placeholder="Harga Jual .. (Wajib)">
              </div>
            </div>

            <div class="form-group">
              <label>Keterangan</label>
              <textarea class="form-control" name="keterangan" placeholder="Masukkan Keterangan Produk .. (Opsional)">{{old('keterangan')}}</textarea>
            </div>

            <div class="form-group">
              <label>Foto <small><i>Opsional</i></small></label>
              <input type="file" name="foto">

            </div>

            <div class="form-group pull-right">
              <input type="submit" class="btn btn-sm btn-primary" value="Simpan">
            </div>
          </form>
        </div>

      </div>
    </section>
  </div>
</section>

</div>

@endsection
