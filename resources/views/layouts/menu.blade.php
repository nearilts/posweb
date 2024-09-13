<header class="main-header">
  <nav class="navbar navbar-static-top">
    <div class="container-fluid">

      <div class="navbar-header">
        <a href="index.php" class="navbar-brand"><b>POS</b> | Point Of Sales</a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>

      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">

        <ul class="nav navbar-nav">

          <li class="active">
            <a href="{{route('dashboard')}}">
              <i class="fa fa-home"></i> &nbsp; <span>DASHBOARD</span> <span class="sr-only">(current)</span>
            </a>
          </li>

              
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-folder"></i> &nbsp; MASTER DATA <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
               @can('Category')
              <li>
                <a href="{{route('category.index')}}">
                  <i class="fa fa-folder"></i> <span>KATEGORI PRODUK</span>
                </a>
              </li>
               @endcan

               @can('Produk')
              <li>
                <a href="{{route('product.index')}}">
                  <i class="fa fa-folder"></i> <span>PRODUK</span>
                </a>
              </li>
               @endcan
            </ul>
          </li>

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-list"></i> &nbsp; PENJUALAN <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              
              @can('Transaksi Create')
              <li>
                <a href="{{route('transaction.create')}}">
                  <i class="fa fa-folder"></i> <span>BUAT TRANSAKSI</span>
                </a>
              </li>
              @endcan


              @can('Transaksi')
              <li>
                <a href="{{route('transaction.index')}}">
                  <i class="fa fa-folder"></i> <span>LIHAT TRANSAKSI</span>
                </a>
              </li>
               @endcan
            </ul>
          </li>
          @can('Pengguna')
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-users"></i> &nbsp; PENGGUNA <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li>
                <a href="{{route('role')}}">
                  <i class="fa fa-user"></i> <span>Role</span>
                </a>
              </li>

              <li>
                <a href="{{route('permission')}}">
                  <i class="fa fa-user"></i> <span>Permission</span>
                </a>
              </li>

              <li>
                <a href="{{route('giveuserrole')}}">
                  <i class="fa fa-user"></i> <span>Role User</span>
                </a>
              </li>
              <li>
                <a href="{{route('users.index')}}">
                  <i class="fa fa-user"></i> <span>Create User</span>
                </a>
              </li>
            </ul>
          </li>
          @endcan

         
 @can('Laporan')
          <li>
            <a href="{{route('report')}}">
              <i class="fa fa-file"></i> &nbsp; <span>LAPORAN</span>
            </a>
          </li>
 @endcan
          
          <li>
            <a href="{{route('gantipassword')}}">
              <i class="fa fa-lock"></i> &nbsp; <span>GANTI PASSWORD</span>
            </a>
          </li>
           

        </ul>


      </div>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-danger">1</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header text-center">Ada <b>1</b> produk yang hampir habis.</li>
              <li>
                <ul class="menu">
                    <li>
                      <a href="produk.php">
                        <i class="fa fa-archive text-red"></i> <b>222</b> <span class="pull-right">tersisa <b>2</b></span>
                      </a>
                    </li>
                </ul>
              </li>
              <li class="footer"><a href="produk.php">Lihat stok produk</a></li>
            </ul>
          </li>

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
             
             
           
              <span class="hidden-xs">{{auth()->user()->name}}</span>
            </a>
          </li>

         
          <li>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out"></i> <span>LOGOUT</span>
            </a>
        
            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                @csrf
            </form>
        </li>

        </ul>
      </div>
    </div>
  </nav>

</header>