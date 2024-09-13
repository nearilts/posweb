{{-- @extends('layouts.template') --}}
@extends('corklayouts.app')
@section('title')
    User Detail
@endsection
@section('content')

<div class="row layout-top-spacing">
        
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
        <div class="widget-content widget-content-area br-6">

                    <div class="row">
                        
                            <div class="col-md-6 col-lg-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-4">
                                        <tr>
                                            <th>Nama</th>
                                            <th>{{ $users->name }}</th>
                                        </tr> 
                                        <tr>
                                            <th>Email</th>
                                            <th>{{ $users->name }}</th>
                                        </tr>
                                        <tr>
                                            <th>Phone</th>
                                            <th>{{ $users->name }}</th>
                                        </tr>
                                    </table>
                                    
                                </div>
                                
                            </div>

                            <div class="col-md-6 col-lg-6">
                                <table class="table table-bordered mb-4">
                                    <tr>
                                        <th>Company Name</th>
                                        <th>{{ isset($users->MCustomer->name) ? $users->MCustomer->name : '-' }}</th>
                                    </tr> 
                                    <tr>
                                        <th>Company Address]</th>
                                        <th>{{ isset($users->MCustomer->address) ? $users->MCustomer->address : '-' }}</th>
                                    </tr>
                                    <tr>
                                        <th>Customer Type</th>
                                        <th>
                                            <form action="{{ route('user.ctype', $users->id) }}" method="POST">
                                                @csrf
                                            <div class="form-group">
                                                <label class="form-label">Customer Type</label>
                                                @php
                                                $no = 0;
                                                @endphp
                                                @foreach ($ctypes as $item)
                        
                                                <div class="custom-control custom-checkbox">
                                                  
                                                    <input type="checkbox" name="m_customer_type_id[]" value="{{ $item->id }}" 
                                                        @foreach ($users->MCustomer->customer_type as $ct)
                                                            @if($ct->id == $item->id) checked @endif 
                                                        @endforeach
                                                    class="custom-control-input" id="customCheck{{ $no }}">
                                                   
                                                    <label class="custom-control-label" for="customCheck{{ $no }}">{{ $item->name }}</label>
                                                </div>
                                                @php
                                                    $no++;
                                                @endphp
                                                @endforeach
                                            </div>    
                                        </th>
                                    </tr>
                                </table>
                                
                                <div class="form-footer">
                                    <button class="btn btn-primary ">Mapping Customer Type</button>
                                    <a href="{{ route('giveuserrole') }}" class="btn btn-success">Back</a>
                                </div>
                            </div>
                               
                        </form>
                            </div>
                        
                        </div>
                        
                    </div>
            </div>
</div>
@endsection