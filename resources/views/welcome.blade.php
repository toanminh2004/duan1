<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <!-- bootstrap css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- custom css -->
  <link rel="stylesheet" href=" {{ asset('CSS_JS/style13.css') }} ">
  <title>@yield('title')</title>
</head>

<body>
  <!-- -------------------------------------------------------------------------------------------------------------------------- Tên Thương Hiệu ------------ -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white py-2">
    <div class="container d-flex flex-wrap justify-content-between">
      <a class="navbar-brand d-flex justify-content-between align-items-center order-lg-0" href="/">
        <span class="text-uppercase">MingShop</span>
      </a>

      <!-- -------------------------------------------------------------------------------------------------------------------- Icon Tiện Ích -------------- -->

      <div class="order-lg-2 nav-btns d-flex flex-wrap align-items-center">

        <button id="toggleThis" type="button" class="btn position-relative">
          <i class="fa fa-search"></i>
        </button>

          <div class="flex-shrink-0 dropdown d-flex flex-wrap">



          @guest
          <a href="/signin"><button type="button" class="btn position-relative">
            <i class="fa-solid fa-circle-user"></i>
          </button></a>
          @else
          <a href="{{ route('allOrder', Auth::user()->id) }}"><button type="button" class="btn position-relative">
            <i class="fa-solid fa-truck-fast"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge bg-primary"></span>
          </button>
          </a>
  
          <a href="{{ route('cart',Auth::user()->id) }}">
            <button type="button" class="btn position-relative">
              <i class="fa fa-shopping-cart"></i>
              <span class="position-absolute top-0 start-100 translate-middle badge bg-primary"></span>
            </button>
          </a>
          <a href="/acc-detail"><button type="button" class="btn position-relative">
            <i class="fa-solid fa-circle-user"></i>
          </button></a>
        <form action="{{ route('postSignout') }}" method="POST">
          @csrf
          <button class="btn position-relative" type="submit">
            <i class="fa-solid fa-sign-out-alt"></i>
          </button>
        </form>
        @if (Auth::user()->hasRole(1))
        <button href="" class="btn position-relative">
          <a href="/ad"><i class="fa-solid fa-tachometer-alt"></i></a>
        </button>
        @endif
          @endguest

        </div> 
      </div>


      <!-- -------------------------------------------------------------------------------------------------------------------- Icon Menu ------------------ -->
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- -------------------------------------------------------------------------------------------------------------------- Menu / Navbar -------------- -->
      <div class="collapse navbar-collapse order-lg-1" id="navMenu">
        <ul class="navbar-nav mx-auto text-center">
          <li class="nav-item px-2 py-2">
            <a class="nav-link text-uppercase text-dark" href="/categories">danh mục sản phẩm</a>
          </li>
          <li class="nav-item px-2 py-2">
            <a class="nav-link text-uppercase text-dark" href="http://asm_php3.test/index.php#about">giới thiệu</a>
          </li>
          <li class="nav-item px-2 py-2 border-0">
            <a class="nav-link text-uppercase text-dark" href="/payment">cách thanh toán</a>
          </li>
          <li class="nav-item px-2 py-2 border-0">
            <a class="nav-link text-uppercase text-dark" href="/warranty">bảo hành</a>
          </li>
        </ul>
      </div>

    </div>

  </nav>



  <!-- ------------------------------------------------------------------------------------------------------------------------ Form Tìm Kiếm -------------- -->
  <div id="searchBox" class="container searchBox p-0 mb-4">
    <form action="index.php?act=product_lists" method="POST">
      <div class="input-group">
        <input type="search" name="kyw" class="form-control" placeholder="Tìm Kiếm Sản Phẩm...">
        <input class="searchBoxButton" type="submit" name="btn_search" value="Tìm">
      </div>
    </form>
  </div>

  @yield('content')

  <!-- footer -->
<footer class="py-5">
    <div class="container">
      <div class="row text-white g-4">
        <div class="col-md-6 col-lg-3">
          <a class="text-uppercase text-decoration-none brand text-white" href="index.html">MINGSHOP</a>
          <p class="text-white mt-3">
            Là một thương hiệu cung cấp những chiếc điện thoại uy tín và chất lượng nhất
            đến cho mọi người, chúng tôi luôn không ngừng học hỏi và cải tiến từ những
            phản hồi góp ý từ các bạn.
          </p>
        </div>
  
        <div class="col-md-6 col-lg-3">
          <h5 class="fw-light mb-3">Liên Hệ</h5>
          <div class="d-flex justify-content-start align-items-start my-2">
            <span class="me-3">
              <i class="fas fa-map-marked-alt"></i>
            </span>
            <a href="https://www.google.com/maps/dir//Trường+Cao+đẳng+FPT+Polytechnic,+Km12+Đ.+Cầu+Diễn,+Phúc+Diễn,+Bắc+Từ+Liêm,+Hà+Nội/@21.045226,105.7049666,13z/data=!4m9!4m8!1m0!1m5!1m1!1s0x313455b3f6710da1:0x240105831b77a1a2!2m2!1d105.746252!2d21.0451509!3e0?entry=ttu"
              class="text-white text-decoration-none">
              FPT Polytechnic - Hà Nội
            </a>
          </div>
          <div class="d-flex justify-content-start align-items-start my-2">
            <span class="me-3">
              <i class="fas fa-envelope"></i>
            </span>
            <span class="fw-light"> minhnptph30982@fpt.edu.vn </span>
          </div>
          <div class="d-flex justify-content-start align-items-start my-2">
            <span class="me-3">
              <i class="fas fa-phone-alt"></i>
            </span>
            <span class="fw-light"> 0868 403 204 </span>
          </div>
        </div>
  
        <div class="col-md-6 col-lg-3">
          <h5 class="fw-light">Liên Kết</h5>
          <ul class="list-unstyled">
            <li class="my-3">
              <a href="/" class="text-white text-decoration-none">
                <i class="fas fa-chevron-right me-1"></i> Trang Chủ
              </a>
            </li>
            <li class="my-3">
              <a href="/categories" class="text-white text-decoration-none">
                <i class="fas fa-chevron-right me-1"></i> Danh mục
              </a>
            </li>
            <li class="my-3">
              <a href="index.php#blogs" class="text-white text-decoration-none">
                <i class="fas fa-chevron-right me-1"></i> Blogs
              </a>
            </li>
            <li class="my-3">
              <a href="index.php#about" class="text-white text-decoration-none">
                <i class="fas fa-chevron-right me-1"></i> Giới Thiệu
              </a>
            </li>
          </ul>
        </div>
  
        <div class="col-md-6 col-lg-3">
          <h5 class="fw-light mb-3">Mạng Xã Hội</h5>
          <div>
            <ul class="list-unstyled d-flex">
              <li>
                <a href="#" class="text-white text-decoration-none fs-4 me-4">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
              <li>
                <a href="#" class="text-white text-decoration-none fs-4 me-4">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
              <li>
                <a href="#" class="text-white text-decoration-none fs-4 me-4">
                  <i class="fab fa-instagram"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
  </body>
  <!-- end of footer -->
  
  <!-- Messenger Plugin chat Code -->
  <div id="fb-root"></div>
  
  <!-- Your Plugin chat code -->
  <div id="fb-customer-chat" class="fb-customerchat">
  </div>
  
  <script>
    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "117080114779838");
    chatbox.setAttribute("attribution", "biz_inbox");
  </script>
  
  <!-- Your SDK code -->
  <script>
    window.fbAsyncInit = function () {
      FB.init({
        xfbml: true,
        version: 'v18.0'
      });
    };
  
    (function (d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>
  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src=" {{ asset('CSS_JS/jquery-3.7.1.js') }} "></script>
  <!-- isotope js -->
  <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <!-- custom js -->
  <script src=" {{ asset('CSS_JS/script2.js') }} "></script>
  <!-- fontawesome cdn -->
  <script src="https://kit.fontawesome.com/9cc1e5b793.js" crossorigin="anonymous"></script>
  
  </html>