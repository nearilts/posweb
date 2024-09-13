@extends('layouts.app')

@section('title')
    Product
@endsection



@section('content')
<div class="row">
    <section class="col-lg-12">
      <div class="box box-info">

        <div class="box-header">
          <h3 class="box-title">Produk</h3>
          @can('Produk Add')
          <a href="{{route('product.create')}}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> &nbsp Tambah Produk Baru</a>
           @endcan             
        </div>
        
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="table-datatable">
              <thead>
                <tr>
                  <th width="1%">NO</th>
                  <th>KODE</th>
                  <th>NAMA PRODUK</th>
                  <th>SATUAN</th>
                  <th>KATEGORI</th>
                  <th>STOK</th>
                  <th>MODAL</th>
                  <th>JUAL</th>
                  <th>KETERANGAN</th>
                  <th width="5%">FOTO</th>
                  <th width="10%">OPSI</th>
                </tr>
              </thead>
              <tbody>
               @php
                   $no=1;
               @endphp
               @foreach ($data as $item)
               <tr>
                 <td><?php echo $no++; ?></td>
                 <td>{{$item->code}}</td>
                 <td>{{$item->name}}</td>
                 <td>{{$item->satuan}}</td>
                 <td>{{$item->category}}</td>
                 <td>{{$item->stok}}</td>
                 <td>{{number_format($item->harga_modal)}}</td>
                 <td>{{number_format($item->harga_jual)}}</td>
                 <td>{{$item->keterangan}}</td>
                 <td>
                  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#foto_{{$item->id}}">
                   <i class="fa fa-image"></i> Lihat
                 </button>

                 <!-- modal hapus -->
                 <div class="modal fade" id="foto_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                   <div class="modal-dialog" role="document">
                     <div class="modal-content">
                       <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                         </button>
                       </div>
                       <div class="modal-body">
                         <center>
                        <img src="{{$item->foto}}" style="width: 100% ;height: auto">

                         </center>

                       </div>
                     </div>
                   </div>
                 </div>

               </td>
               <td>                        
                  @can('Produk Edit')
                 <a class="btn btn-warning btn-sm" href="{{route('product.edit', $item)}}"><i class="fa fa-cog"></i></a>
                  @endcan

                @can('Produk Hapus')
                 <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_produk_{{$item->id}}">
                    <i class="fa fa-trash"></i>
                  </button>
                @endcan
                  <!-- modal hapus -->
                  <div class="modal fade" id="hapus_produk_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Peringatan!</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">

                          <p>Yakin ingin menghapus produk ini ?</p>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                          <button type="button" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('hapus_{{$item->id}}').submit();">
                            <i class="fa fa-trash"></i>
                          </button>
                          <form id="hapus_{{$item->id}}" method="POST" action="{{ route('product.destroy', $item) }}" style="display: none;">
                            @method('delete')
                            @csrf
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>

               </td>
             </tr>
                   
               @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </section>
@endsection