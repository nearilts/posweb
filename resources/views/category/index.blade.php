@extends('layouts.app')

@section('title')
    Category
@endsection


@section('content')
    


      <div class="row">
        <section class="col-lg-8 col-lg-offset-2">
          <div class="box box-success">
  
            <div class="box-header">
              <h3 class="box-title">Kategori</h3>
              <div class="btn-group pull-right">            
                @can('Category Add')
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                  <i class="fa fa-plus"></i> &nbsp Tambah Kategori
                </button>
                @endcan
               
              </div>
            </div>
            <div class="box-body">
  
              <!-- Modal -->
              <form action="{{route('category.store')}}" method="post">
                @csrf
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                      </div>
                      <div class="modal-body">
  
                        <div class="form-group">
                          <label>Nama Kategori</label>
                          <input type="text" name="name" required="required" class="form-control" placeholder="Nama Kategori ..">
                        </div>
  
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
  
  
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="table-datatable">
                  <thead>
                    <tr>
                      <th width="1%">NO</th>
                      <th>NAMA</th>
                      <th width="10%">OPSI</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->name }}</td>
                            <td>                  
                              @can('Category Edit')
                              
                              <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_kategori_{{$item->id}}">
                                <i class="fa fa-cog"></i>
                              </button>
                              @endcan
                

                                  @can('Category Hapus')
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
                                          <form id="hapus_{{$item->id}}" method="POST" action="{{ route('category.destroy', $item) }}" style="display: none;">
                                            @method('delete')
                                            @csrf
                                        </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>


        
                                <form action="{{route('category.update', $item)}}" method="post">
                                    @method('patch')
                                    @csrf
                                  <div class="modal fade" id="edit_kategori_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                          <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                                        </div>
                                        <div class="modal-body">
        
                                          <div class="form-group" style="width:100%">
                                            <label>Nama Kategori</label>
                                            <input type="text" name="name" required="required" class="form-control" placeholder="Nama Kategori .." value="{{$item->name}}" style="width:100%">
                                          </div>
        
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                          <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </form>
        
        
                              </td>
                        </tr>
                    @endforeach
                   
                  </tbody>
                </table>
              </div>
            </div>
  
          </div>
        </section>
      </div>


@endsection