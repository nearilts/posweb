@extends('layouts.app')

@section('title')
    Data User
@endsection


@section('content')
    


      <div class="row">
        <section class="col-lg-8 col-lg-offset-2">
          <div class="box box-success">
  
            <div class="box-header">
              <h3 class="box-title">User</h3>
              <div class="btn-group pull-right">            
  
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                  <i class="fa fa-plus"></i> &nbsp Tambah User
                </button>
              </div>
            </div>
            <div class="box-body">
  
              <!-- Modal -->
              <form action="{{route('users.store')}}" method="post">
                @csrf
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                      </div>
                      <div class="modal-body">
  
                        <div class="form-group">
                          <label>Nama User</label>
                          <input type="text" name="name" required="required" class="form-control" placeholder="Nama User ..">
                        </div>
                        <div class="form-group">
                          <label>Username</label>
                          <input type="text" name="username" required="required" class="form-control" placeholder="Username  ..">
                        </div>
                        <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" required="required" class="form-control" placeholder="password  ..">
                        </div>
                        <div class="form-group">
                          <label>Foto</label>
                          <input type="file" name="foto"  class="form-control" placeholder="Username  ..">
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
                      <th>Username</th>
                      <th>Foto</th>
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
                            <td>{{ $item->username }}</td>
                            <td><img src="{{ $item->foto }}" alt="" width="100px"></td>
                            <td>    
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_User_{{$item->id}}">
                                    <i class="fa fa-cog"></i>
                                  </button>


                                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_produk_{{$item->id}}">
                                    <i class="fa fa-trash"></i>
                                  </button>
              
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
                                          <form id="hapus_{{$item->id}}" method="POST" action="{{ route('users.destroy', $item) }}" style="display: none;">
                                            @method('delete')
                                            @csrf
                                        </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>


        
                                <form action="{{route('users.update', $item)}}" method="post">
                                    @method('patch')
                                    @csrf
                                  <div class="modal fade" id="edit_User_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                          <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                        </div>
                                        <div class="modal-body">
        
                                          <div class="form-group" style="width:100%">
                                            <label>Nama User</label>
                                            <input type="text" name="name" required="required" class="form-control" placeholder="Nama User .." value="{{$item->name}}" style="width:100%">
                                          </div>
                                          <div class="form-group" style="width:100%">
                                            <label>Username</label>
                                            <input type="text" name="username" required="required" class="form-control" placeholder="Username .." value="{{$item->username}}" style="width:100%">
                                          </div>
                                          <div class="form-group" style="width:100%">
                                            <label>Password</label>
                                            <input type="password" name="password"  class="form-control" placeholder="kosongkan untuk tidak mengganti password .." value="" style="width:100%">
                                          </div>
                                          <div class="form-group" style="width:100%">
                                            <label>Foto</label>
                                            <input type="file" name="foto"  class="form-control" placeholder="password .."  style="width:100%">
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