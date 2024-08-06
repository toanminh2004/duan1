@extends('welcome')

@section('title')
    Trang chủ
@endsection

@section('content')
<title>MingShop - Trang Chủ</title>

<style>
  @media screen and (max-width: 1200px ){
    .side_banner1 {
      display: none;
    }
    .side_banner2 {
      display: none;
    }

  }
  .side_banner1 {
    position: fixed;
    width: 10%;
    margin-top: 16px;
    left: 40px;
    border-radius: 5px;
    z-index: 5;
    box-shadow: 0px 0px 5px gray;
  }

  .side_banner2 {
    position: fixed;
    width: 10%;
    margin-top: 16px;
    right: 40px;
    border-radius: 5px;
    z-index: 5;
    box-shadow: 0px 0px 5px gray;
  }
  
</style>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
{{--    Hiển thị thông báo thành công--}}
@if(session('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>
@endif

{{--    Hiển thị thông báo lỗi--}}
@if(session('error'))
<div class="alert alert-danger">
    {{session('error')}}
</div>
@endif

<!-- ------------------------------------------------------------------------------------------------------------------------------- Chuyển Ảnh ------------ -->
<div class="container mt-3 mb-5 p-0">
  <div class="row g-0">
    <div id="carouselExampleIndicators" class="col-12 col-xl-12 carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
          aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
          aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
          aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="  {{ asset('images/banner01.webp') }} " class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="{{ asset('images/banner02.jpg') }}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="{{ asset('images/banner03.jpg') }}" class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Trước</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Sau</span>
      </button>
    </div>

    
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var myCarousel = new bootstrap.Carousel(document.getElementById('carouselExampleIndicators'), {
      interval: 3000, // Thời gian chuyển ảnh mỗi 2 giây
      wrap: true // Cho phép chuyển đến ảnh đầu tiên sau khi đến ảnh cuối cùng
    });
  });
</script>

<!-- -------------------------------------------------------------------------------------------------------------------------- SIÊU KHUYẾN MÃI ------------ -->
<div id="sale" class="container pb-3 my-5"
  style="background-image: linear-gradient(to right, #0E2241 , #00b3ff); border-radius: 10px; box-shadow: 0px 0px 5px gray;">
  <div class="row p-0">
    <div class="d-flex justify-content-start">
      <h2 class="title-product m-0" style="background-color: white; color: orangered; mix-blend-mode: luminosity;">SIÊU
        KHUYẾN MÃI <i class="fa-solid fa-percent"></i></h2>
    </div>

{{-- KHUYẾN MÃI --}}

@foreach ($prosales as $item)
<div class="col-6 col-md-4 col-lg-3 col-xl-2 mt-4">
  <div class="card border-0" style="width: 100%;">
    <div class="collection-img position-relative">
      <a href="{{ route('product.show', $item->product_id) }}"><img
          src="{{ Storage::url($item->product_image) }}" class="card-img-top" alt="..."></a>
      
        <span class="position-absolute bg-primary text-white d-flex align-items-center justify-content-center">-
          {{ $item->sale_percent }}%
        </span>
    </div>
    <div class="card-body">
      <div class="product-title">
        <a href=" {{ route('product.show', $item->product_id) }}">
          {{ $item->product_name }}
        </a>
      </div>
      <div>
        @foreach ($sales as $sale)
        @if ($item->sale_id == $sale->sale_id)
        <del class="old-price">
          {{ $item->product_price }}đ
        </del>
        <span class="new-price">
          {{ ($item->product_price*(100-$item->sale_percent))/100 }}đ
        </span>
        @else
            
        @endif
          
        @endforeach
      </div>
      <div>
        <span class="rate-quantity">{{ $item->product_description }}</span>
      </div>
    </div>
  </div>
  
</div>
@endforeach



  </div>
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center mt-3 m-0">
      <li class="page-item disabled">
        <a class="page-link">Trước</a>
      </li>
      <li class="page-item"><a class="page-link" href="index.php?page_key_board=">
        1
      </a></li>
      <li class="page-item">
        <a class="page-link" href="#">Sau</a>
      </li>
    </ul>
  </nav>
</div>


{{-- DANH MỤC - SẢN PHẨM --}}

@foreach ($categories as $cat)
<div class="container pb-3 my-5"
  style="background-color: white; border-radius: 10px; box-shadow: 0px 0px 5px gainsboro;">
  <div class="row p-0">
    <div class="d-flex justify-content-start">
      <h2 class="title-product m-0"> {{ $cat->category_name }} </h2>
    </div>
          @foreach ($products as $pro)

          @if ($pro->category_id == $cat->id)
          <div class="col-6 col-md-4 col-lg-3 col-xl-2 mt-4">
            <div class="card" style="width: 100%;">
              <div class="collection-img position-relative">
                <a href=" {{ route('product.show', $pro->product_id) }}"><img
                    src=" {{ Storage::url($pro->product_image) }} " class="card-img-top" alt="..."></a>

                    @foreach ($sales as $sale)
                        @if ($pro->sale_id == $sale->sale_id)
                        <span class="position-absolute bg-primary text-white d-flex align-items-center justify-content-center">-
                          {{ $pro->sale_percent }}%
                        </span>
                        @endif
                    @endforeach

              </div>
              <div class="card-body">
                <div class="product-title">
                  <a href=" {{ route('product.show', $pro->product_id) }}">
                    {{ $pro->product_name }}
                  </a>
                </div>
                <div>
                  @if ($pro->sale_id)
                  <del class="old-price">
                    {{ $pro->product_price }}đ
                  </del>
                  <span class="new-price">
                    {{ ($pro->product_price*(100-$pro->sale_percent))/100 }}đ
                  </span>
                  @else
                  <span class="new-price">
                    {{ $pro->product_price }}đ
                  </span>
                  @endif
                    

                </div>
                <div>
                  <span class="rate-quantity">{{ $pro->product_description }}</span>
                </div>
              </div>
            </div>
          </div>
      
          @endif
              
          @endforeach
        </div>

        </div>
      </div>
  </div>
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center mt-3 m-0">
      <li class="page-item disabled">
        <a class="page-link">Trước</a>
      </li>
      
        <li class="page-item"><a class="page-link" href="index.php?page_key_board=">
            1
          </a></li>
      <li class="page-item">
        <a class="page-link" href="#">Sau</a>
      </li>
    </ul>
  </nav>
</div>
@endforeach


<!-- ------------------------------------------------------------------------------------------------------------------------- Banner Quảng Cáo ------------ -->
<section id="offers" class="py-5 mt-5">
  <div class="container">
    <div
      class="row d-flex align-items-center justify-content-center text-center justify-content-lg-start text-lg-start">
      <div class="offers-content">
        <span class="text-white">Siêu Khuyến Mãi!</span>
        <h2 class="mt-2 mb-4 text-white">Giảm Giá Tới 50%</h2>
        <a href="#sale" class="btn">Mua Ngay</a>
      </div>
    </div>
  </div>
</section>


<!-- blogs -->
<div class="container my-5" style="background-color: white; border-radius: 10px; box-shadow: 0px 0px 5px gainsboro;">
  <section id="blogs">
    <div class="container">
      <div class="title text-center py-5">
        <h2 class="position-relative d-inline-block">BLOGS MỚI NHẤT</h2>
      </div>

      <div class="row g-3">
        <div class="card border-0 col-md-6 col-lg-4 bg-transparent my-3">
          <img src=" {{ asset('images/blog_1.jpg') }} " alt="" />
          <div class="card-body px-0">
            <h4 class="card-title">
              Lorem ipsum, dolor sit amet consectetur adipisicing
            </h4>
            <p class="card-text mt-3 text-muted">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet
              aspernatur repudiandae nostrum dolorem molestias odio. Sit fugit
              adipisci omnis quia itaque ratione iusto sapiente reiciendis,
              numquam officiis aliquid ipsam fuga.
            </p>
            <p class="card-text">
              <small class="text-muted">
                <span class="fw-bold">Tác Giả: </span>John Doe
              </small>
            </p>
            <a href="#" class="btn">Đọc Thêm</a>
          </div>
        </div>

        <div class="card border-0 col-md-6 col-lg-4 bg-transparent my-3">
          <img src="{{ asset('images/blog_2.jpg') }}" alt="" />
          <div class="card-body px-0">
            <h4 class="card-title">
              Lorem ipsum, dolor sit amet consectetur adipisicing
            </h4>
            <p class="card-text mt-3 text-muted">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet
              aspernatur repudiandae nostrum dolorem molestias odio. Sit fugit
              adipisci omnis quia itaque ratione iusto sapiente reiciendis,
              numquam officiis aliquid ipsam fuga.
            </p>
            <p class="card-text">
              <small class="text-muted">
                <span class="fw-bold">Tác Giả: </span>John Doe
              </small>
            </p>
            <a href="#" class="btn">Đọc Thêm</a>
          </div>
        </div>

        <div class="card border-0 col-md-6 col-lg-4 bg-transparent my-3">
          <img src="{{ asset('images/blog_3.jpg') }}" alt="" />
          <div class="card-body px-0">
            <h4 class="card-title">
              Lorem ipsum, dolor sit amet consectetur adipisicing
            </h4>
            <p class="card-text mt-3 text-muted">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet
              aspernatur repudiandae nostrum dolorem molestias odio. Sit fugit
              adipisci omnis quia itaque ratione iusto sapiente reiciendis,
              numquam officiis aliquid ipsam fuga.
            </p>
            <p class="card-text">
              <small class="text-muted">
                <span class="fw-bold">Tác Giả: </span>John Doe
              </small>
            </p>
            <a href="#" class="btn">Đọc Thêm</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- end of blogs -->

<!-- ------------------------------------------------------------------------------------------------------------------------------- Giới Thiệu ------------ -->
<section id="about" class="py-5">
  <div class="container">
    <div class="row gy-lg-5 align-items-center">
      <div class="col-lg-6 order-lg-1 text-center text-lg-start">
        <div class="title pt-3 pb-4">
          <h2 class="position-relative d-inline-block ms-4 text-white">GIỚI THIỆU</h2>
        </div>
        <p class="lead text-white">
          BLUETECH - Một sàn thương mại điện tử về công nghệ
        </p>
        <p class="text-white">
          Với mong muốn cung cấp những sản phẩm công nghệ uy tín và chất lượng nhất đến cho mọi người, chúng tôi
          luôn không ngừng học hỏi và cải tiến từ những phản hồi góp ý từ các bạn.
        </p>
      </div>
      <div class="col-lg-6 order-lg-0">
        <a href="#"><img src=" {{ asset('images/gioithieu.jpg') }} " class=" img-fluid" /></a>
      </div>
    </div>
  </div>
</section>



<!-- newsletter -->
<section id="newsletter" class="py-5">
  <div class="container">
    <div class="d-flex flex-column align-items-center justify-content-center">
      <div class="title text-center pt-3 pb-5">
        <h2 class="position-relative d-inline-block ms-4">
          ĐĂNG KÝ HỘI VIÊN
        </h2>
      </div>

      <p class="text-center text-muted">
        Chúng tôi sẽ gửi những thông tin mới nhất về các sản phẩm và dịch vụ
        khuyến mãi cho bạn qua Email, hãy đón chờ nhé!
      </p>
      <div class="input-group mb-3 mt-3">
        <input type="text" class="form-control" placeholder="Nhập Email..." />
        <button class="btn btn-primary" type="submit">Đăng Ký</button>
      </div>
    </div>
  </div>
</section>
<!-- end of newsletter -->

<!-- Scroll To Top -->
<a href="#" class="to-top" onclick="scrollToTop();"><i class="fa-solid fa-angle-up"></i></a>
<!-- End Scroll To Top -->
<script type="text/javascript">
  window.addEventListener("scroll", function () {
    var scroll = document.querySelector(".to-top");
    scroll.classList.toggle("active", window.scrollY > 500);
  });

  function scrollToTop() {
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  }
</script>

<script>
  function formatNumber(num) {
      return num.toLocaleString();
  }
</script>
@endsection