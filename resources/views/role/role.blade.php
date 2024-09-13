{{-- @extends('layouts.template') --}}
@extends('layouts.app')

@section('content')
@php
use Spatie\Permission\Models\Permission;

@endphp

<div class="col-md-4">  
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">Tambah Data</h3>
      </div>
      <div class="box-body">

                   <form action="{{ route('give.role', $user) }}" method="POST">
                       @csrf
                       {{--  <div class="form-group">
                        <label for="role">Name</label>
                        <input type="text" class="form-control" id="role" name="name" placeholder="Name">
                    </div>  --}}

                    <div class="form-group">
                        @php
                            $no = 0;
                        @endphp
                        @foreach ($roles as $item)

                        <div class="custom-control custom-checkbox">
                            @if (isset($arr[$no]))
                            <input type="checkbox" name="name[]" value="{{ $item->name }}" @if($item->name == $arr[$no]) checked @endif class="custom-control-input" id="customCheck{{ $no }}">
                            @else
                            <input type="checkbox" name="name[]" value="{{ $item->name }}" class="custom-control-input" id="customCheck{{ $no }}">
                            @endif
                            <label class="custom-control-label" for="customCheck{{ $no }}">{{ $item->name }}</label>
                          </div>
                        @php
                            $no++;
                        @endphp
                        @endforeach
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                   </form>
                   
            </div>
        </div>


</div>
@endsection
