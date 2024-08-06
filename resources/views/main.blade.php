<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>MingShop - Admin</title>
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/images/favicon.png') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendor/owl-carousel/css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendor/owl-carousel/css/owl.theme.default.min.css') }}">
  <link href="{{ asset('admin/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/vendor/summernote/summernote.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
</head>

<body>
  <div id="main-wrapper">
    <div class="nav-header">
      <a href="/ad" class="brand-logo">
        MINGSHOP
      </a>

      <div class="nav-control">
        <div class="hamburger">
          <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
      </div>
    </div>
    <div class="header">
      <div class="header-content">
        <nav class="navbar navbar-expand">
          <div class="collapse navbar-collapse justify-content-between">
            <div class="header-left">
              <div class="search_bar dropdown">
                <div class="dropdown-menu p-0 m-0">
                </div>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </div>

    <div class="quixnav">
      <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
          
      

              <li class="nav-label">Quản Lý Cửa Hàng</li>

              <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa-solid fa-circle-user"></i><span
                    class="nav-text">Phân Quyền Người Dùng</span></a>
                <ul aria-expanded="false">
                  <li><a href="{{ route('users') }}">Danh Sách Người Dùng</a></li>
                </ul>
              </li>

              <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                    class="fa-solid fa-store"></i><span class="nav-text">Sản Phẩm</span></a>
                <ul aria-expanded="false">
                  <li><a href="{{ route('ad-product.index') }}">
                    Danh Sách Sản Phẩm</a></li>
                  <li><a href="{{ route('ad-product.create') }}">Thêm Sản Phẩm</a></li>
                </ul>
              </li>
              
              <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                    class="fa-solid fa-list"></i><span class="nav-text">Danh Mục</span></a>
                <ul aria-expanded="false">
                  <li><a href="{{ route('ad-category.index') }}">Danh Sách Danh Mục</a></li>
                  <li><a href="{{ route('ad-category.create') }}">Thêm Danh Mục</a></li>
                </ul>
              </li>

              <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa-solid fa-tag"></i><span
                    class="nav-text">Sales</span></a>
                <ul aria-expanded="false">
                  <li><a href="{{ route('ad-sale.index') }}">Danh Sách Sales</a></li>
                  <li><a href="{{ route('ad-sale.create') }}">Thêm Sales</a></li>
                </ul>
              </li>
              <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa-solid fa-clipboard-list"></i><span
                    class="nav-text">Quản lí đơn hàng</span></a>
                <ul aria-expanded="false">
                  <li><a href="{{ route('ad-bill.index') }}">Danh Sách Đơn Hàng</a></li>
                </ul>
              </li>
              <li>
                <a class="" href="/" aria-expanded="false">
                  <i class="fas fa-arrow-left"></i><span
                    class="nav-text">Quay về trang Web</span></a>
              </li>

      </div>
    </div>

    @yield('content')

</body>
<script src="{{ asset('admin/vendor/global/global.min.js') }}"></script>
<script src="{{ asset('admin/js/quixnav-init.js') }}"></script>
<script src="{{ asset('admin/js/custom.min.js') }}"></script>

<!-- Vectormap -->
<script src="{{ asset('admin/vendor/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('admin/vendor/morris/morris.min.js') }}"></script>

<script src="{{ asset('admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
<script src="{{ asset('admin/vendor/chart.js/Chart.bundle.min.js') }}"></script>

<script src="{{ asset('admin/vendor/gaugeJS/dist/gauge.min.js') }}"></script>

<!--  flot-chart js -->
<script src="{{ asset('admin/vendor/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('admin/vendor/flot/jquery.flot.resize.js') }}"></script>

<!-- Owl Carousel -->
<script src="{{ asset('admin/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>

<!-- Counter Up -->
<script src="{{ asset('admin/vendor/jqvmap/js/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('admin/vendor/jqvmap/js/jquery.vmap.usa.js') }}"></script>
<script src="{{ asset('admin/vendor/jquery.counterup/jquery.counterup.min.js') }}"></script>

<script src="{{ asset('admin/js/dashboard/dashboard-1.js') }}"></script>
<!-- Required vendors -->
<script src="{{ asset('admin/vendor/global/global.min.js') }}"></script>
<script src="{{ asset('admin/js/quixnav-init.js') }}"></script>
<script src="{{ asset('admin/js/custom.min.js') }}"></script>



<!-- Datatable -->
<script src="{{ asset('admin/vendor/datatables/js/jquery.dataTables.min.js') }} "></script>
<script src="{{ asset('admin/js/plugins-init/datatables.init.js') }} "></script>
<!-- Summernote -->
<script src="{{ asset('admin/vendor/summernote/js/summernote.min.js') }} "></script>
<!-- Summernote init -->
<script src="{{ asset('admin/js/plugins-init/summernote-init.js') }} "></script>
<!-- fontawesome cdn -->
<script src="https://kit.fontawesome.com/9cc1e5b793.js" crossorigin="anonymous"></script>

</html>