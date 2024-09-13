@extends('layouts.app')

@section('title')
Ganti Password
@endsection


@section('content')

<div class="content-wrapper">


  <section class="content">
    <div class="row">
      <section class="col-lg-5 col-lg-offset-3">


        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Ganti Password</h3>
          </div>
          <div class="box-body">
            <form action="{{route('gantipassword_act')}}" method="post">
                @csrf
              <div class="form-group">
                <label>Masukkan Password Baru</label>
                <input type="password" class="form-control" placeholder="Masukkan Password Baru .." name="password" required="required" min="5">
              </div>
              <div class="form-group">
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