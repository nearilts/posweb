@include('layouts.header')





<div class="content-wrapper">

    <section class="content-header">
      <h1>
        @yield('title')
        <small>Data @yield('title')</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">@yield('title')</li>
      </ol>
  
    </section>
  
    <section class="content">

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        
        @elseif (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        @yield('content')

        
    </section>
  
</div>


@include('layouts.footer')