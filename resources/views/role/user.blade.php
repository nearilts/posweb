{{-- @extends('layouts.template') --}}
@extends('layouts.app')

@section('content')

<div class="col-md-12">  
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title"> Data</h3>
      </div>
      <div class="box-body">
                    <table id="zero-config" class="table table-hover">
                    <thead>
                         <tr>
                           <th>No</th>
                           <th>User</th>
                           <th>Role</th>
                           <th>Give Role</th>
                       </tr>
                    </thead>
                    <tbody>
                       @php
                           $no =1;
                       @endphp
                       @forelse ($users as $user)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $user->name }}</td>
                                <td>
                                        @php
                                        $userRole = $user->roles->all();
                                        @endphp

                                        @foreach ($userRole as $rp)
                                            <p> <strong>{{ $rp->name }} </strong></p>
                                        @endforeach
                                    </td>
                                <td>
                                    <a href="{{ route('give.role', $user) }}" class="btn btn-sm btn-primary">Give Role</a>
                                    {{-- <a href="{{ route('user.detail', $user) }}" class="btn btn-sm btn-primary">View Detail</a> --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">Not found</td>
                            </tr>
                        @endforelse
                        </tbody>
                   </table>
            </div>
        </div>

</div>
@endsection
