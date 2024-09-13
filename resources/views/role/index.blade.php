{{-- @extends('layouts.template') --}}

@extends('layouts.app')

@section('content')

<div class="col-md-4">  
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">Tambah Data</h3>
      </div>
      <div class="box-body">
          
      <form action="{{ route('create.role') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="role">Name</label>
            <input type="text" class="form-control" id="role" name="name" placeholder="Name">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
<div class="col-md-8">  
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title"> Data</h3>
      </div>
      <div class="box-body">
        <table class="table box-table table-vcenter text-nowrap datatable">
        <thead>
            <tr>
               <th>No</th>
               <th>Role</th>
               <th>Give Permission</th>
           </tr>
        </thead>
        <tbody>
            @php
                $no =1;
            @endphp
           @forelse ($roles as $role)
               <tr>
                   <td>{{ $no++ }}</td>
                   <td>{{ $role->name }}</td>

                   <td><a href="{{ route('give.permission', $role) }}" class="btn btn-primary">Give Permission</a></td>
                </tr>
           @empty
               <tr>
                   <td colspan="7">Not found</td>
               </tr>
           @endforelse
            </tbody>
       </table>
      <!-- /.box-body -->
    </div>
</div>
</div>    
@endsection
